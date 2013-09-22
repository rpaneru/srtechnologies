 function isCreditCard( num ) 
 {                         
       	num = (num + '').replace(/\D+/g, '').split('').reverse();
	if (!num.length)
		return false;
	var total = 0, i;
	for (i = 0; i < num.length; i++) {
		num[i] = parseInt(num[i])
		total += i % 2 ? 2 * num[i] - (num[i] > 4 ? 9 : 0) : num[i];
	}
	if(total==0)
	return (false);
	else
	{
	return (total % 10) == 0;
	}
 }