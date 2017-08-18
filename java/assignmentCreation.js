// $(document).ready(function()
// {
//   $("#part1").show();
//   $("#part1-1").hide();
//   $("#part1-2").hide();
//   $("#part2").hide();
//   $("#part3").hide();
//   $("#review").hide();
//
//   var a,b,c,d,e,f,g,h,i,j,k,l,m;
//
//   $("input[type='radio']").click(function(){
//       var check = $(this).val();
//       if(check =='yes')
//       {
//         $("#part1-1").slideup("slow");
//         $("#part1-2").hide();
//         $("#courseError").html(" ");
//       }
//       else
//       {
//         $("#part1-2").show();
//         $("#part1-1").hide();
//         $("#courseError").html(" ");
//       }
//   });
//
//   $("button[type='button']").click(function(){
//     var check = $(this).val();
//     if(check =='backto1')
//     {
//       $("#part2").hide();
//       $("#part1").show();
//       $("#courseError").html(" ");
//     }
//     if(check =='backto2')
//     {
//       $("#part3").hide();
//       $("#part2").show();
//       $("#courseError").html(" ");
//     }
//     if(check == 'backto3')
//     {
//       $("#review").hide();
//       $("#part3").show();
//       $("#courseError").html(" ");
//     }
//
// });
