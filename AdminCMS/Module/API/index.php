<?php
// ملف index.php المحسن مع Logger
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

// تسجيل بدء الطلب
if (file_exists("../Classes/PhSoft/cPhsLogger.php")) {
    require_once "../Classes/PhSoft/cPhsLogger.php";
    if (class_exists('cPhsLogger')) {
        cPhsLogger::info("API Request Started", [
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'Unknown',
            'uri' => $_SERVER['REQUEST_URI'] ?? 'Unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
        ]);
    }
}

// تحسين إدارة الجلسات
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// استخدام try-catch للتعامل مع الأخطاء
try {
    require_once "../Classes/PhSoft/cPhsRestBase.php";
    require_once "../Classes/PhSoft/cPhsRest.php";
    require_once "../PhCFG.php";
    require_once "../MySQL.php";
    require_once "../PhFunctions.php";
    require_once "../CpyFunctions.php";
    require_once "../CpyRouter.php";
    require_once "../PhPMail.php";

    // تحضير البيانات
    ph_PrepareGets();
    ph_PreparePosts();
    ph_PrepareRequests();

    $oRest = new cPhsRest(PHS_URI_IDX + 1);
    
    if ($oRest->isOK) {
        // تسجيل النجاح في تهيئة REST
        if (class_exists('cPhsLogger')) {
            cPhsLogger::info("REST initialized successfully", ['path' => $oRest->URL[cPhsRest::URL_KEY_PATH] ?? 'Unknown']);
        }
        
        // تحسين تحميل الإعدادات
        cPhsPref::$Prefs = cPhsPref::loadDBKeys();
        $vLang = cPhsPref::getPref('Def_Language') ?: 'en';
        $oLang = cPhsLang::getInstanceByCode($vLang);
        
        // تحسين تحميل الترجمات
        $vLabelsFile = "../PhLabels-{$oLang->Code}.php";
        if (!file_exists($vLabelsFile)) {
            $vLabelsFile = "../PhLabels-en.php";
        }
        require_once $vLabelsFile;
        initLabels();

        // التحقق من التوثيق
        if ($oRest->URL[cPhsRest::URL_KEY_AUTH] ?? false) {
            $oUser = unserialize(ph_Session('User') ?: '');
            $oLang = unserialize(ph_Session('Lang') ?: '');
            
            if (!$oUser || $oUser->StatusId != 1) {
                if (class_exists('cPhsLogger')) {
                    cPhsLogger::security("Unauthorized access attempt", [
                        'user_id' => $oUser->Id ?? 'Unknown',
                        'path' => $oRest->URL[cPhsRest::URL_KEY_PATH] ?? 'Unknown'
                    ]);
                }
                
                $oRest->setError(getLabel('lbl.cms.Invalid User Status') ?: 'Invalid User Status', cPhsRestBase::HTTP_CODE_UNAUTHORIZED);
                throw new Exception(getLabel('lbl.cms.Invalid User Status') ?: 'Invalid User Status');
            }
            
            // إعادة تحميل الترجمات للمستخدم
            $vLabelsFile = "../PhLabels-{$oLang->Code}.php";
            if (!file_exists($vLabelsFile)) {
                $vLabelsFile = "../PhLabels-en.php";
            }
            require_once $vLabelsFile;
            initLabels();
        }

        // إنشاء مجلدات ضرورية
        $vAttacheRootPath = PHS_SERVER_ROOT_PATH;
        if (!file_exists($vAttacheRootPath)) {
            mkdir($vAttacheRootPath, 0755, true);
            if (class_exists('cPhsLogger')) {
                cPhsLogger::info("Created attachment directory", ['path' => $vAttacheRootPath]);
            }
        }

        // تنفيذ الخدمة
        $serviceName = 'ws/' . ($oRest->URL[cPhsRest::URL_KEY_URL] ?? '') . '.php';
        
        if (file_exists($serviceName)) {
            if (class_exists('cPhsLogger')) {
                cPhsLogger::info("Service file found", ['service' => $serviceName]);
            }
            include $serviceName;
        } else {
            $errorMessage = (getLabel('lbl.cms.Unknown Service') ?: 'Unknown Service') . 
                          " Path=[{$oRest->URL[cPhsRest::URL_KEY_PATH]}] " .
                          "Method=[{$oRest->URL[cPhsRest::URL_KEY_METHOD]}] " .
                          "URL=[$serviceName]";
            
            if (class_exists('cPhsLogger')) {
                cPhsLogger::warning("Service file not found", [
                    'path' => $oRest->URL[cPhsRest::URL_KEY_PATH] ?? 'Unknown',
                    'method' => $oRest->URL[cPhsRest::URL_KEY_METHOD] ?? 'Unknown',
                    'service_name' => $serviceName
                ]);
            }
            
            $oRest->setError($errorMessage, cPhsRestBase::HTTP_CODE_NOT_FOUND);
        }
    }
    
} catch (Exception $e) {
    if (class_exists('cPhsLogger')) {
        cPhsLogger::error("API Exception", [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
    }
    
    if (isset($oRest)) {
        if (!$oRest->getStatus()) { // فقط إذا لم يتم تعيين حالة الخطأ مسبقاً
            $oRest->setError($e->getMessage(), cPhsRestBase::HTTP_CODE_INTERNAL_SERVER_ERROR);
        }
    }
}

// تسجيل الرد النهائي
if (isset($oRest)) {
    if (class_exists('cPhsLogger')) {
        cPhsLogger::apiRequest(
            $_SERVER['REQUEST_METHOD'] ?? 'Unknown',
            $_SERVER['REQUEST_URI'] ?? 'Unknown',
            $oRest->getCode(),
            $oUser->Id ?? null
        );
        
        cPhsLogger::info("API Request Completed");
    }
    
    $oRest->returnResponse();
}