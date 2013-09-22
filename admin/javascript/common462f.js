/* Common Javascript functions for use throughout StoreSuite */

// Fetch the value of a cookie
function get_cookie(name) {
	name = name += "=";
	var cookie_start = document.cookie.indexOf(name);
	if(cookie_start > -1) {
		cookie_start = cookie_start+name.length;
		cookie_end = document.cookie.indexOf(';', cookie_start);
		if(cookie_end == -1) {
			cookie_end = document.cookie.length;
		}
		return unescape(document.cookie.substring(cookie_start, cookie_end));
	}
}

// Set a cookie
function set_cookie(name, value, expires)
{
	if(!expires) {
		expires = "; expires=Wed, 1 Jan 2020 00:00:00 GMT;"
	} else {
		expire = new Date();
		expire.setTime(expire.getTime()+(expires*1000));
		expires = "; expires="+expire.toGMTString();
	}
	document.cookie = name+"="+escape(value)+expires;
}

/* Javascript functions for the products page */
var num_products_to_compare = 0;
var product_option_value = "";

function showProductImage(filename, product_id) {
	var l = (screen.availWidth/2)-350;
	var t = (screen.availHeight/2)-300;
	window.open(filename + "?product_id="+product_id, "imagePop", "toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=700,height=600,top="+t+",left="+l);
}

function check_add_to_cart(form, required) {
	if(required && !$(form).find('input:checked').length) {
		alert(lang.OptionMessage);
		return false;
	}

	return true;
}

function compareProducts(compare_path) {
	var pids = "";
	if(num_products_to_compare >= 2) {
		var cpids = document.frmCompare.compare_product_ids;

		for(i = 0; i < cpids.length; i++) {
			if(cpids[i].checked)
				pids = pids + cpids[i].value + "/";
		}

		pids = pids.replace(/\/$/, "");
		document.location.href = compare_path + pids;
		return false;
	}
	else {
		alert(lang.CompareSelectMessage);
		return false;
	}
}

function product_comparison_box_changed(state) {
	// Increment num_products_to_compare - needs to be > 0 to submit the product comparison form
	if(state)
		num_products_to_compare++;
	else
		num_products_to_compare--;
}

function remove_product_from_comparison(id) {
	if(num_compare_items > 2) {
		for(i = 1; i < 11; i++) {
			document.getElementById("compare_"+i+"_"+id).style.display = "none";
		}

		num_compare_items--;
	}
	else {
		alert(lang.CompareTwoProducts);
	}
}

function show_product_review_form() {
	document.getElementById("rating_box").style.display = "";
	document.location.href = "#write_review";
}

function jump_to_product_reviews() {
	document.location.href = "#reviews";
}

function g(id) {
	return document.getElementById(id);
}

function check_product_review_form(no_rating_message, no_title_message, no_text_message, no_captcha_message) {
	var revrating = g("revrating");
	var revtitle = g("revtitle");
	var revtext = g("revtext");
	var revfromname = g("revfromname");
	var captcha = g("captcha");

	if(revrating.selectedIndex == 0) {
		alert(no_rating_message);
		revrating.focus();
		return false;
	}

	if(revtitle.value == "") {
		alert(no_title_message);
		revtitle.focus();
		return false;
	}

	if(revtext.value == "") {
		alert(no_text_message);
		revtext.focus();
		return false;
	}

	if(captcha.value == "" && HideReviewCaptcha != "none") {
		alert(no_captcha_message);
		captcha.focus();
		return false;
	}

	return true;
}

function remove_item_from_cart(remove_msg, item_id) {
	if(confirm(remove_msg))
		document.location.href = "cart3d26.html?action=remove&amp;item="+item_id;
}

function update_cart_qty(item_id, qty, remove_msg) {
	if(qty == 0) {
		if(confirm(remove_msg))
			document.location.href = "cart6f11.html?action=update&amp;item="+item_id+"&qty="+qty;
	}
	else {
		document.location.href = "cart6f11.html?action=update&amp;item="+item_id+"&qty="+qty;
	}
}

function check_coupon_code(coupon_msg) {
	var couponcode = g("couponcode");

	if(couponcode.value == "") {
		alert(coupon_msg);
		couponcode.focus();
		return false;
	}
}

function check_gift_certificate_code(coupon_msg) {
	var giftcertificatecode = g("giftcertificatecode");

	if(giftcertificatecode.value == "") {
		alert(coupon_msg);
		giftcertificatecode.focus();
		return false;
	}
}

function check_small_search_form() {
	var search_query = g("search_query");

	if(search_query.value == "") {
		alert(lang.EmptySmallSearch);
		search_query.focus();
		return false;
	}

	return true;
}

// Dummy sel_panel function for when design mode isn't enabled
function sel_panel(id) {}


// Dummy JS object to hold language strings.
var lang = {
};

// IE 6 doesn't support the :hover selector on elements other than links, so
// we use jQuery to work some magic to get our hover styles applied.
if(document.all) {
	var isIE7 = /*@cc_on@if(@_jscript_version>=5.7)!@end@*/false;
	if(isIE7 == false) {
		$(document).ready(function() {
			$('.ProductList li').hover(function() {
				$(this).addClass('Over');
			},
			function() {
				$(this).removeClass('Over');
			});
			$('.ComparisonTable tr').hover(function() {
				$(this).addClass('Over');
			},
			function() {
				$(this).removeClass('Over');
			});
		});
	}
	$('.ProductList li:last-child').addClass('LastChild');
}

$(document).ready(function() {
	$('.InitialFocus').focus();
});

$(document).ready(function() {
	$('.countrySelect').each(function() {
		var id = this.id;
		if(!this.id) {
			return;
		}
		var stateSelectId = id+'_state';

		if(document.getElementById(stateSelectId) == null) {
			return;
		}
		$(this).change(function() {
			$.ajax({
				url: '/remote.php?action=stateSelect&country='+escape($(this).val()),
				type: 'get',
				success: function(data) {
					var stateSelect = $('#'+stateSelectId);
					// Show the text box
					if(!data) {
						var input = document.createElement('input');
						input.type = 'text';
					}
					else {
						var input = document.createElement('select');
						input.innerHTML = data;
					}
					input.name = $(stateSelect).attr('name');
					input.className = $(stateSelect).attr('class');
					input.id = stateSelectId;
					input.style.width = $(stateSelect).css('width');
					$(stateSelect).replaceWith(input);
				}
			});
		});
	});
});


function clear_form_elements(ele) {

	$(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
			case 'select-multiple':
			case 'select-one':
            case 'text':
			case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
	});

}
