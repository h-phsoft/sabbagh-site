<?php include_once "Classes/Copy/cCpyPGrp.php" ?>
<?php include_once "Classes/Copy/cCpyPerm.php" ?>
<?php include_once "Classes/Copy/cCpyUser.php" ?>
<?php include_once "Classes/Copy/cCpyVuser.php" ?>

<?php include_once "Classes/App/Dist/cDistAbout.php" ?>
<?php include_once "Classes/App/Dist/cDistBlog.php" ?>
<?php include_once "Classes/App/Dist/cDistBrands.php" ?>
<?php include_once "Classes/App/Dist/cDistCategories.php" ?>
<?php include_once "Classes/App/Dist/cDistColor.php" ?>
<?php include_once "Classes/App/Dist/cDistCountry.php" ?>
<?php include_once "Classes/App/Dist/cDistDistination.php" ?>
<?php include_once "Classes/App/Dist/cDistGallery.php" ?>
<?php include_once "Classes/App/Dist/cDistGroups.php" ?>
<?php include_once "Classes/App/Dist/cDistPrefs.php" ?>
<?php include_once "Classes/App/Dist/cDistProducts.php" ?>
<?php include_once "Classes/App/Dist/cDistServices.php" ?>
<?php include_once "Classes/App/Dist/cDistSlider.php" ?>
<?php include_once "Classes/App/Dist/cDistSocial.php" ?>
<?php include_once "Classes/App/Dist/cDistSuppliers.php" ?>
<?php include_once "Classes/App/Dist/cDistTag.php" ?>
<?php include_once "Classes/App/Dist/cDistTeam.php" ?>
<?php include_once "Classes/App/Dist/cDistTestimonial.php" ?>
<?php

/**
 * Site Common classes and functions
 * (C) 2000-2023 PhSoft.
 */
function getSearFlds($flds) {
  $aSarchflds = array(
    'Branch' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Phone' => 'UPPER(`phone`) LIKE UPPER("%{SearchText}%")',
      'Address' => 'UPPER(`address`) LIKE UPPER("%{SearchText}%")',
    ),
    'Perm' => array(
      'Id' => '`id`="{SearchText}"',
      'GrpId' => '`grp_id`="{SearchText}"',
      'ProgId' => '`prog_id`="{SearchText}"',
      'Isok' => '`isok`="{SearchText}"',
      'Ins' => '`ins`="{SearchText}"',
      'Upd' => '`upd`="{SearchText}"',
      'Qry' => '`qry`="{SearchText}"',
      'Del' => '`del`="{SearchText}"',
      'Prt' => '`prt`="{SearchText}"',
      'Exp' => '`exp`="{SearchText}"',
      'Imp' => '`imp`="{SearchText}"',
      'Cmt' => '`cmt`="{SearchText}"',
      'Rvk' => '`rvk`="{SearchText}"',
      'Spc' => '`spc`="{SearchText}"',
    ),
    'PermGrp' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'WpstatusId' => '`wpstatus_id`="{SearchText}"',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'Token' => array(
      'Id' => '`id`="{SearchText}"',
      'Gid' => 'UPPER(`gid`) LIKE UPPER("%{SearchText}%")',
      'UserId' => '`user_id`="{SearchText}"',
      'StatusId' => '`status_id`="{SearchText}"',
      'Sdate' => '`sdate`=STR_TO_DATE("{SearchText}", "%Y-%m-%d")',
      'Edate' => '`edate`=STR_TO_DATE("{SearchText}", "%Y-%m-%d")',
      'Adate' => '`adate`=STR_TO_DATE("{SearchText}", "%Y-%m-%d")',
      'Pvkey' => 'UPPER(`pvkey`) LIKE UPPER("%{SearchText}%")',
      'Pbkey' => 'UPPER(`pbkey`) LIKE UPPER("%{SearchText}%")',
      'Ip' => 'UPPER(`ip`) LIKE UPPER("%{SearchText}%")',
      'Port' => 'UPPER(`port`) LIKE UPPER("%{SearchText}%")',
      'Host' => 'UPPER(`host`) LIKE UPPER("%{SearchText}%")',
    ),
    'User' => array(
      'Id' => '`id`="{SearchText}"',
      'BranId' => '`bran_id`="{SearchText}"',
      'GrpId' => '`grp_id`="{SearchText}"',
      'GenderId' => '`gender_id`="{SearchText}"',
      'StatusId' => '`status_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Logon' => 'UPPER(`logon`) LIKE UPPER("%{SearchText}%")',
      'Password' => 'UPPER(`password`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Vuser' => array(
      'Id' => '`id`="{SearchText}"',
      'BranId' => '`bran_id`="{SearchText}"',
      'BranName' => 'UPPER(`bran_name`) LIKE UPPER("%{SearchText}%")',
      'GrpId' => '`grp_id`="{SearchText}"',
      'StatusId' => '`status_id`="{SearchText}"',
      'GenderId' => '`gender_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Logon' => 'UPPER(`logon`) LIKE UPPER("%{SearchText}%")',
      'Password' => 'UPPER(`password`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'About' => array(
      'Id' => '`id`="{SearchText}"',
      'Title' => 'UPPER(`title`) LIKE UPPER("%{SearchText}%")',
      'Paragraph' => 'UPPER(`paragraph`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Blog' => array(
      'Id' => '`id`="{SearchText}"',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
      'Title' => 'UPPER(`title`) LIKE UPPER("%{SearchText}%")',
      'PostedBy' => 'UPPER(`posted_by`) LIKE UPPER("%{SearchText}%")',
      'Text' => 'UPPER(`text`) LIKE UPPER("%{SearchText}%")',
    ),
    'Categories' => array(
      'Id' => '`id`="{SearchText}"',
      'SupplierId' => '`supplier_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Color' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
    ),
    'Country' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Distination' => array(
      'Id' => '`id`="{SearchText}"',
      'CountryId' => '`country_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Gallery' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Groups' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
    ),
    'Team' => array(
      'Id' => '`id`="{SearchText}"',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Work' => 'UPPER(`work`) LIKE UPPER("%{SearchText}%")',
      'Facebook' => 'UPPER(`facebook`) LIKE UPPER("%{SearchText}%")',
      'Twitter' => 'UPPER(`twitter`) LIKE UPPER("%{SearchText}%")',
      'Instagram' => 'UPPER(`instagram`) LIKE UPPER("%{SearchText}%")',
      'Linkedin' => 'UPPER(`linkedin`) LIKE UPPER("%{SearchText}%")',
    ),
    'Prefs' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Val' => 'UPPER(`val`) LIKE UPPER("%{SearchText}%")',
    ),
    'Products' => array(
      'Id' => '`id`="{SearchText}"',
      'CategoryId' => '`category_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Services' => array(
      'Id' => '`id`="{SearchText}"',
      'Ord' => '`ord`="{SearchText}"',
      'Title' => 'UPPER(`title`) LIKE UPPER("%{SearchText}%")',
      'Paragraph' => 'UPPER(`paragraph`) LIKE UPPER("%{SearchText}%")',
      'Icon' => 'UPPER(`icon`) LIKE UPPER("%{SearchText}%")',
    ),
    'Slider' => array(
      'Id' => '`id`="{SearchText}"',
      'Ord' => '`ord`="{SearchText}"',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
    ),
    'Social' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Icon' => 'UPPER(`icon`) LIKE UPPER("%{SearchText}%")',
      'Link' => 'UPPER(`link`) LIKE UPPER("%{SearchText}%")',
    ),
    'Suppliers' => array(
      'Id' => '`id`="{SearchText}"',
      'GroupId' => '`group_id`="{SearchText}"',
      'CountryId' => '`country_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
      'Price' => 'UPPER(`price`) LIKE UPPER("%{SearchText}%")',
      'Paragraph' => 'UPPER(`paragraph`) LIKE UPPER("%{SearchText}%")',
    ),
    'Tag' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'ColorId' => '`color_id`="{SearchText}"',
    ),
    'Testimonial' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Country' => 'UPPER(`country`) LIKE UPPER("%{SearchText}%")',
      'Town' => 'UPPER(`town`) LIKE UPPER("%{SearchText}%")',
      'Image' => 'UPPER(`image`) LIKE UPPER("%{SearchText}%")',
      'Paragraph' => 'UPPER(`paragraph`) LIKE UPPER("%{SearchText}%")',
    ),
    'Vpackages' => array(
    ),
    'Vtags' => array(
      'TagId' => '`tag_id`="{SearchText}"',
      'TagName' => 'UPPER(`tag_name`) LIKE UPPER("%{SearchText}%")',
      'ColorId' => '`color_id`="{SearchText}"',
      'ColorName' => 'UPPER(`color_name`) LIKE UPPER("%{SearchText}%")',
    ),
    'Vtypes' => array(
    ),
    'CodBoolean' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Rem' => '`rem`="{SearchText}"',
    ),
    'CodDataType' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'CodGender' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'CodStatus' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'CodYesNo' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'Lang' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Code' => 'UPPER(`code`) LIKE UPPER("%{SearchText}%")',
      'Dir' => 'UPPER(`dir`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'Log' => array(
      'Id' => '`id`="{SearchText}"',
      'LogText' => 'UPPER(`log_text`) LIKE UPPER("%{SearchText}%")',
      'LogDate' => '`log_date`=STR_TO_DATE("{SearchText}", "%Y-%m-%d")',
    ),
    'Pref' => array(
      'Id' => '`id`="{SearchText}"',
      'CmsId' => '`cms_id`="{SearchText}"',
      'TypeId' => '`type_id`="{SearchText}"',
      'Key' => 'UPPER(`key`) LIKE UPPER("%{SearchText}%")',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Value' => 'UPPER(`value`) LIKE UPPER("%{SearchText}%")',
      'Rem' => 'UPPER(`rem`) LIKE UPPER("%{SearchText}%")',
    ),
    'Program' => array(
      'Id' => '`id`="{SearchText}"',
      'ProgId' => '`prog_id`="{SearchText}"',
      'SysId' => '`sys_id`="{SearchText}"',
      'GrpId' => '`grp_id`="{SearchText}"',
      'StatusId' => '`status_id`="{SearchText}"',
      'TypeId' => '`type_id`="{SearchText}"',
      'Open' => '`open`="{SearchText}"',
      'Ord' => '`ord`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Icon' => 'UPPER(`icon`) LIKE UPPER("%{SearchText}%")',
      'File' => 'UPPER(`file`) LIKE UPPER("%{SearchText}%")',
      'Css' => 'UPPER(`css`) LIKE UPPER("%{SearchText}%")',
      'Js' => 'UPPER(`js`) LIKE UPPER("%{SearchText}%")',
      'Attributes' => 'UPPER(`attributes`) LIKE UPPER("%{SearchText}%")',
      'Params' => 'UPPER(`params`) LIKE UPPER("%{SearchText}%")',
    ),
    'ProgramType' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
    ),
    'System' => array(
      'Id' => '`id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'StatusId' => '`status_id`="{SearchText}"',
    ),
    'Vprogram' => array(
      'Id' => '`id`="{SearchText}"',
      'ProgId' => '`prog_id`="{SearchText}"',
      'Name' => 'UPPER(`name`) LIKE UPPER("%{SearchText}%")',
      'Ord' => '`ord`="{SearchText}"',
      'Icon' => 'UPPER(`icon`) LIKE UPPER("%{SearchText}%")',
      'GrpId' => '`grp_id`="{SearchText}"',
      'Open' => '`open`="{SearchText}"',
      'StatusId' => '`status_id`="{SearchText}"',
      'StatusName' => 'UPPER(`status_name`) LIKE UPPER("%{SearchText}%")',
      'File' => 'UPPER(`file`) LIKE UPPER("%{SearchText}%")',
      'Css' => 'UPPER(`css`) LIKE UPPER("%{SearchText}%")',
      'Js' => 'UPPER(`js`) LIKE UPPER("%{SearchText}%")',
      'Attributes' => 'UPPER(`attributes`) LIKE UPPER("%{SearchText}%")',
      'SysId' => '`sys_id`="{SearchText}"',
      'SysName' => 'UPPER(`sys_name`) LIKE UPPER("%{SearchText}%")',
      'TypeId' => '`type_id`="{SearchText}"',
      'TypeName' => 'UPPER(`type_name`) LIKE UPPER("%{SearchText}%")',
    ),
  );
  $aRet = array();
  if (isset($aSarchflds[$flds])) {
    $aRet = $aSarchflds[$flds];
  }
  return $aRet;
}

function getCondition($vSearchText, $vSearchFld, $flds) {
  $aSearchFlds = getSearFlds($flds);
  $vWhere = '';
  //$vWhere = 'id>0';
  if ($vSearchText != '') {
    $vWhere .= '(';
    if (strtolower($vSearchFld) == 'all') {
      $vOR = '';
      foreach ($aSearchFlds as $value) {
        $vWhere .= $vOR . str_replace('{SearchText}', $vSearchText, $value);
        $vOR = ' OR ';
      }
    } else {
      if (isset($aSearchFlds[strtolower($vSearchFld)])) {
        $vWhere .= str_replace('{SearchText}', $vSearchText, $aSearchFlds[$vSearchFld]);
      }
    }
    $vWhere .= ')';
  }
  return $vWhere;
}
