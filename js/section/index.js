// $(document).ready(function(){
//     mask_load.render();

//     let xhr=new XMLHttpRequest();

//     xhr.addEventListener('readystatechange', function(){
//         if(this.readyState==4){
//             if(this.status==200){
//                 let posts=JSON.parse(this.response).posts, content="";

//                 posts.forEach(function(post){
//                     if(post.SECTION_URL==section)
//                         content+="<a href='" + post.NAME_URL + "'>" + post.NAME + " <i class='fa fa-external-link'></i></a>";
//                 });

//                 $('.content').append(content);

//                 mask_load.hide();
//             }
//             else{
//                 alert('Unexpected error occurred with status ' + this.status);

//                 mask_load.hide();
//             }
//         }
//     });

//     xhr.open('GET', '../admin/php/get_data.php');

//     xhr.send(null);
// });