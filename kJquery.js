/**
* Adding Jqueryfunctionality to html page 
* Created By: Kirti
* Date: 17/06/2016
**/ 

var itemCount = 0;
var item=0;
var rowIndex = 0;
var NAME,GENDER,AGE,ADDRESS,EMAIL;
var currentRow;

//validation of each data
function validate(){
         var email = $("#email").val();
   
        //Validate Name
        if($("#name").val() === "" ){
                $("#name").focus();
                $("#errorBox").html("enter the First Name");
                return false;
             }
    
        //validate age
        if($("#age").val() === ""||$("#age").val() <1|| $("#age").val() >100 ){
                 $("#age").focus();
                 $("#errorBox").html("age must be between 1 to 100");
                 return false;
             }
             
        //validate gender
        if($('input[name=gender]:checked').length<=0){
                 $("#errorBox").html("Select gender");
                 return false;
            }
            
        //validate email
        if($("#email").val() === "" ){
                 $("#email").focus();
                 $("#errorBox").html("enter the email");
                 return false;
            }
    
    
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email)) {
                $("#errorBox").html("Invalid email");
                $("#email").focus();
                return false;
             }
    
        return true;
            

}
function add()
{
  
     if(!validate())
     {
         return false;
      }   
     NAME=  $("#name").val();
     AGE= $("#age").val();
     GENDER=$("#gender").val();
     ADDRESS=$("#address").val();
     EMAIL=$("#email").val();
     $.ajax({url: "http://localhost/user_mgmt/php/addUser.php",
        type: 'post',
        data: {php_name:NAME,php_age:AGE,php_gender:GENDER,php_address:ADDRESS,php_email:EMAIL},
        success: function(response)
         {
            var users = JSON.parse(response);
            $.each(users, function(i,arr){
                var out;
                out =  "<tr ><td>"+ arr.recordId + "</td> <td>" +  arr.name+ " </td> <td>" + arr.gender + " </td><td>"+ arr.age + "</td><td>"+ arr.address + "</td><td>"+ arr.email +
                       "</td><td><input type='button'  class='deleteBtn' value='delete'></td> <td><input type='button'  id='updateBtn' value='update'></td></tr>";   
                $("#table").append(out);
            });
        },
        error: function()
            {
                alert("MYerror");
            }
        
     });
}
    
$(document).ready(function(){
      
                  //ajax call
    $.ajax({url: "http://localhost/user_mgmt/php/getAll.php",
        type: 'post',
        data: {},
        success: function(response)
        {
            //console.log(response);
            //$("#table").html(response);
            var users = JSON.parse(response);
            $.each(users, function(i,arr){
                var out;
                out =  "<tr ><td>"+ arr.recordId + "</td> <td>" +  arr.name+ " </td> <td>" + arr.gender + " </td><td>"+ arr.age + "</td><td>"+ arr.address + "</td><td>"+ arr.email +
                       "</td><td><input type='button'  class='deleteBtn' value='delete'></td> <td><input type='button'  class='updateBtn' value='update'></td></tr>";   
                $("#table").append(out);
               
              
                
            });
            $('.deleteBtn').on("click", deleteUser);
            $('.updateBtn').on("click", edit); 
        },
        error: function()
        {
            alert("hello");
        }
    
    });
    
    $("#add").on("click", add);     
});

function deleteUser()
{
    var recrdId= $(this).closest('tr').find('td')[0].innerHTML;
    var row=$(this);
    $.ajax({url: "http://localhost/user_mgmt/php/delete.php",
        type: 'post',
        data: {recordId:recrdId},
        success: function(response)
        {
            
            row.closest('tr').remove();
        },
        error: function()
        {
            //alert("error");
        }
            });
}



function edit()
    {
        currentRow=$(this);
        var idx = $(this).parent().parent();
        rowIndex=idx;
        $("#name").val(idx.find('td')[1].innerHTML);
        $("#age").val(idx.find('td')[2].innerHTML);
        $("#gender").val(idx.find('td')[3].innerHTML);
        $("#address").val(idx.find('td')[4].innerHTML);
        $("#email").val(idx.find('td')[5].innerHTML);
        
    }
    
function editRow()
{
    NAME=  $("#name").val();
    AGE= $("#age").val();
    GENDER=$("#gender").val();
    ADDRESS=$("#address").val();
    EMAIL=$("#email").val();
    var recrdId= currentRow.closest('tr').find('td')[0].innerHTML;
    $.ajax({url: "http://localhost/user_mgmt/php/edit.php",
            type: 'post',
            data: {recordId:recrdId,php_name:NAME,php_age:AGE,php_gender:GENDER,php_address:ADDRESS,php_email:EMAIL},
            success: function(response)
             {
             },
            error: function()
            {
            alert("error");
            }
     });
}
   
   
  