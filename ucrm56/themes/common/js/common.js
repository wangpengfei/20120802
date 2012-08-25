//<!--
function CheckNumChar(str)
{
    var i,j,strTemp;
    strTemp='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_.-';
    for (i = 0; i < str.length; i++)  {
         j = strTemp.indexOf(str.charAt(i));
         if (j == -1)                  
              return 0;
    }
    
    return 1;
}
	
function checkSpecialChar(str)
{
    var i,j,strTemp;
    
    strTemp = '\@*\'\"|,<>&\/%?';
    for (i = 0;i<str.length;i++)  {
		j = strTemp.indexOf(str.charAt(i));
		if (j != -1)
			return 0;
    }
    
    return 1;
}
// -->	
