function hoverStar(e){if(this.index>=activeStars)for(var t=activeStars>0?activeStars:0;t<=this.index;t++)starRatings[t].className="mouseover"==e.type?"hover":"";else if("mouseover"==e.type)for(var r=activeStars-1;r>this.index;r--)starRatings[r].className="";else if("mouseleave"==e.type)for(var a=0;a<activeStars;a++)starRatings[a].className="hover"}function clickStar(e){activeStars-=1;for(var t=activeStars>this.index?activeStars:this.index,r=0;r<=t;r++)starRatings[r].className=this.index!=activeStars&&r<=this.index?"hover":"";activeStars=document.querySelectorAll("#star-ratings star.hover").length,document.querySelector("#selected-rating span").innerHTML=activeStars,document.getElementById("rating").value=activeStars}function formSubmit(e){e.preventDefault();var t=this,r=t.querySelector('input[name="display"]');t.classList.contains("display-form")&&r.setAttribute("value","0"==r.value?"1":"0");var a=getFormData(t);reqwest({url:t.action,method:t.method,type:"json",data:a,success:function(e){e.message&&(document.getElementById("wrapper").innerHTML=e.message),e.display&&(t.querySelector("button").className="1"==r.value?"added":"")},error:function(e){console.log(e)}})}function getFormData(e){var r=["INPUT","TEXTAREA","SELECT"],a={};for(t=0;t<r.length;t++)for(var i=e.getElementsByTagName(r[t]),s=0;s<i.length;s++)a[i[s].name]=i[s].value;e.querySelector('[name="_submit"]')&&(a._submit=e.querySelector('[name="_submit"]').value);var n=(new Date).getTime();return a.c_time=(n-loadTime)/1e3<7?1:0,a}function grabToken(e){var t=(new Date).getTime();reqwest({url:"/token-gen/"+e.id+"?_="+t,method:"GET",type:"json",success:function(t){e.querySelector('[name="_submit"]').value=t.token,e.querySelector("#token").value=randomString(t.token)},error:function(e){console.log(e)}})}function randomString(e){for(var t="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",r=5,a="",i=0;i<r;i++){var s=Math.floor(Math.random()*t.length);a+=t.substring(s,s+1)}return e+a}function externalClicked(){document.getElementById("clicked").value="1",form.dispatchEvent(new Event("submit"))}var starRatings=document.querySelectorAll("#star-ratings star"),activeStars=0;if(starRatings.length>0)for(var i=0;i<starRatings.length;i++)starRatings[i].index=i,starRatings[i].addEventListener("mouseover",hoverStar),starRatings[i].addEventListener("mouseleave",hoverStar),starRatings[i].addEventListener("click",clickStar);var loadTime=(new Date).getTime(),reviewsForm=document.getElementById("reviews-form");reviewsForm&&(grabToken(reviewsForm),reviewsForm.addEventListener("submit",formSubmit));var reviews=document.querySelectorAll("#reviews-list form");if(reviews.length>0)for(var i=0;i<reviews.length;i++)reviews[i].addEventListener("submit",formSubmit);