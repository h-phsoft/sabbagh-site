let SystemACC = 1100;
let SystemInv = 1200;
let SystemFIX = 1104;
let SystemHR = 1130;
let SystemLRG = 7050;

let PhFOper_EQ = 0;
let PhFOper_NE = 1;
let PhFOper_GT = 2;
let PhFOper_GE = 3;
let PhFOper_LT = 4;
let PhFOper_LE = 5;
let PhFOper_BT = 6;
let PhFOper_NB = 7;
let PhFOper_ST = 8;
let PhFOper_ED = 9;
let PhFOper_CT = 10;
let PhFOper_NST = 11;
let PhFOper_NED = 12;
let PhFOper_NCT = 13;

let PhFOperations = [
  {sign: '=', label: getLabel('qoper.equal')},
  {sign: '!=', label: getLabel('qoper.not.equal')},
  {sign: '>', label: getLabel('qoper.greater.than')},
  {sign: '>=', label: getLabel('qoper.grater.than.or.equal')},
  {sign: '<', label: getLabel('qoper.less.than')},
  {sign: '<=', label: getLabel('qoper.less.than.or.equal')},
  {sign: '<>', label: getLabel('qoper.between')},
  {sign: '><', label: getLabel('qoper.not.between')},
  {sign: '[%', label: getLabel('qoper.start.with')},
  {sign: '%]', label: getLabel('qoper.end.with')},
  {sign: '%', label: getLabel('qoper.contain')},
  {sign: '![%', label: getLabel('qoper.not.start.with')},
  {sign: '!%]', label: getLabel('qoper.not.end.with')},
  {sign: '!%', label: getLabel('qoper.not.contain')}
];

let PhFOperations1 = [
  {sign: '=', label: '='},
  {sign: '!=', label: '!='},
  {sign: '>', label: '>'},
  {sign: '>=', label: '>='},
  {sign: '<', label: '<'},
  {sign: '<=', label: '<='},
  {sign: '<>', label: '<>'},
  {sign: '><', label: '><'},
  {sign: '[%', label: '[%'},
  {sign: '%]', label: ']%'},
  {sign: '%', label: '%'},
  {sign: '![%', label: '![%'},
  {sign: '!%]', label: '!%]'},
  {sign: '!%', label: '!%'}
];

let PhFDT_String = 0;
let PhFDT_Number = 1;
let PhFDT_Date = 2;

let PhFC_Text = 0;
let PhFC_Select = 1;
let PhFC_Number = 2;
let PhFC_DatePicker = 3;
let PhFC_Autocomplete = 4;
let PhFC_CheckBox = 5;
let PhFC_Radio = 6;

let PhF_Type_Form = 1;
let PhF_Type_MstTrn = 2;
let PhF_Type_Tree = 3;

let PhF_Mode_Query = 1;
let PhF_Mode_Enter = 2;

let PhF_Toogle_New = 1;
let PhF_Toogle_Query = 2;
let PhF_Toogle_Execute = 3;
let PhF_Toogle_Edite = 4;
let toogleType = PhF_Toogle_New;

let PhF_Action_New = 1;
let PhF_Action_Update = 2;

let PhF_Query_1 = 1;
let PhF_Query_2 = 2;
let PhF_Query_3 = 3;

let toggleCriteria = true;

/******************************/
field = {
  label: '', // Use In Table Header
  element: 'fld___Id', // Same In JSP Page
  rElement: 'fld___Name', // Same In JSP Page  ( Autoomplete )
  field: '___Id', // Same in DB accId
  rField: '___Name', // Same in DB accName  FOr Table Body ( Select / Autocomplete )
  isRequired: true, // Same In JSP Page
  defValue: '', // Default Value
  Value: '', //  Static Value
  options: [], // Array ( Select )
  tableWidth: 0, // Table Width
  alert: {// Form Alert
    value: 1, // Form Alert Value
    message: '' // Form Alert Message
  }
};

/******************************/
QField = {
  label: '', // Query Form
  element: '___Id', // Query Id
  field: '___Id', // Query DB
  component: '', // Query Component ( Text , Number , Slect ,.....)
  defValue: -1, //  Default Value
  minValue: '',
  step: '',
  maxValue: '',
  options: [], // Array ( Select )
  autoCompleteApi: '', // Autocomplete Api
  aOpers: [] // Array Operations
};

/********* Number ***************/
let aNOpers = [PhFOper_EQ, PhFOper_NE, PhFOper_GT, PhFOper_GE,
  PhFOper_LT, PhFOper_LE, PhFOper_BT, PhFOper_NB, PhFOper_ST,
  PhFOper_ED, PhFOper_CT, PhFOper_NST, PhFOper_NED, PhFOper_NCT];

/********* Text ******/
let aTOpers = [PhFOper_EQ, PhFOper_NE, PhFOper_ST, PhFOper_NST,
  PhFOper_CT, PhFOper_NCT, PhFOper_ED, PhFOper_NED];

/********* Date ******/
let aDOpers = [PhFOper_EQ, PhFOper_NE, PhFOper_GT, PhFOper_GE,
  PhFOper_LT, PhFOper_LE, PhFOper_BT, PhFOper_NB, PhFOper_CT, PhFOper_NCT];

/********* Select  / AC ******/
let aSAOpers = [PhFOper_EQ, PhFOper_NE];

/****************************/
EField = {
  label: '', // Use In Table Header
  colLabel: '', //
  colElement: '', //
  component: '', // Query Component ( Text , Number , Slect ,.....)
  element: 'fld___Id', // Same In JSP Page
  rElement: 'fld___Name', // Same In JSP Page  ( Autoomplete )
  field: '___Id', // Same in DB accId
  rField: '___Name', // Same in DB accName  FOr Table Body ( Select / Autocomplete )
  isRequired: true, // Same In JSP Page
  defValue: '', // Default Value
  Value: '', //  Static Value
  autoCompleteApi: '', // Autocomplete Api
  options: [], // Array ( Select )
  aOpers: [] // Array Operations
};
