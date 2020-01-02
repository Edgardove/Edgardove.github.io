// $(document).ready(function(){
//     mask_load.render();

//     let xhr=new XMLHttpRequest();

//     xhr.addEventListener('readystatechange', function(){
//         if(this.readyState==4){
//             if(this.status==200){
//                 let sections=JSON.parse(this.response).sections, content="";

//                 sections.forEach(function(section){
//                     content+="<a href='" + section.NAME_URL + "'><div class='card'><div class='image'><img src='" + section.NAME_URL + "/images/icon.png'></div><div class='text_content'><h1>" + section.NAME + "</h1><p>" + section.META_DESCRIPTION + "</p></div></div></a>";
//                 });

//                 $('.content').html(content);

//                 mask_load.hide();
//             }
//             else{
//                 alert('Unexpected error occurred with status ' + this.status);

//                 mask_load.hide();
//             }
//         }
//     });

//     xhr.open('GET', 'admin/php/get_data.php');

//     xhr.send(null);
// });