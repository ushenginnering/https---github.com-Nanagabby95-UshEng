
<script>
  <?php
  include "router.php";
?>

let router = {
  post: (
    url,
    body,
    alwaysFnc = () => {
      console.log("done");
    }
  ) => {
    return new Promise((resolve, reject) => {
      $.post(url, body)
        .done((data) => {
          resolve(data);
        })
        .fail((error) => {
          reject(error);
        })
        .always((data, status, x) => {
          alwaysFnc();
        });
    });
  },
  get: (
    url,
    alwaysFnc = () => {
      console.log("done");
    }
  ) => {
    return new Promise((resolve, reject) => {
      $.get(url)
        .done((data) => {
          resolve(data);
        })
        .fail((error) => {
          reject(error);
        })
        .always((data, status, x) => {
          alwaysFnc();
        });
    });
  },
};

/*
let youtube_link = () => {
  // fetch wallets
  router
    .get(
      get_youtube_link()
    )
    .then((data) => {
      data = JSON.parse(data);
      
      if (data?.status) {
        append_to_site(data?.message);
      }
    })
    .catch((err) => {
      console.log(err);
    });
};

function append_to_site(path)  {
  var ko = JSON.parse(path);
  console.log(ko[0]);
  var youtubeLink  = ko[0]?.resource_link;
  console.log(youtubeLink);
 
  // parse the video ID from the YouTube link
  var videoId = youtubeLink.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/)?(.+)/)[1];

  // set the video ID as the src attribute of the iframe element
  $("#youtube-link-here").attr("src", "https://www.youtube.com/embed/" + videoId + "?mute=0&showinfo=0&controls=0&start=0");

}
*/


/*
let notification = {
  warning: (message) => {
    if ($(".__notification")) {
      $(".__notification")
      .removeClass("alert-success")
      .removeClass("alert-danger")
        .text(message)
        .addClass("alert-warning")
        .css({ width: "fit-content" })
        .show();
        $(".__notification")[0].scrollIntoView({
          behavior:"smooth",
          block:"end"
        })
      setTimeout(() => {
        $(".__notification")
          .hide()
          .text("")
          .removeClass("alert-warning");
      }, 10000);
    }
  },
  danger: (message) => {
    if ($(".__notification")) {
      $(".__notification")
      .removeClass("alert-warning")
        .removeClass("alert-success")
        .text(message)
        .addClass("alert-danger")
        .css({ width: "fit-content" })
        .show();
      $(".__notification")[0].scrollIntoView({
        behavior: "smooth",
        block: "end",
      });

      setTimeout(() => {
        $(".__notification")
          .text("")
          .removeClass("alert-danger")
          .hide();
      }, 10000);
    }
  },
  success: (message) => {
    if ($(".__notification")) {
      $(".__notification")
      .removeClass("alert-warning")
      .removeClass("alert-danger")
        .text(message)
        .addClass("alert-success")
        .css({ width: "fit-content" })
        .show();
      $(".__notification")[0].scrollIntoView({
        behavior: "smooth",
        block: "end",
      });
      setTimeout(() => {
        $(".__notification")
          .text("")
          .removeClass("alert-success")
          .hide();
      }, 10000);
    }
  },
};


*/

let parse_json_response = (jsonString, searchTerm="add_user_status") => {
    const regex = /{[^{}]*}/g;
    const matches = jsonString.match(regex) || [];
    let json_match = matches.filter(match => match.includes(searchTerm))
    function isValidJson(jsonString) {
      try {
        JSON.parse(jsonString);
        return true;
      } catch (error) {
        return false;
      }
    }
    
    if(matches?.length > 0){
      if(isValidJson(json_match[0])){
        return JSON.parse(json_match[0])
      }else{
        return []
      }
    }else{
      return []
    }
  }

  let handle_wait_list = (formData) => {
    $("#wait-list-post")
      .attr("value", "Loading...")
      .attr("disabled", true)
      .addClass("disable");
    $.ajax({
      url: post_new_user(),
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: (data) => {
        $("#wait-list-post")
          .attr("value", "Join now")
          .removeAttr("disabled")
          .removeClass("disable");
        data = parse_json_response(data);
        if (data?.add_user_status) {
          notification.success(data?.message);
          $("#name").val("");
          $("#email").val("");
          $("#phone").val("");
          $("#school").val("");
        } else {
          notification.danger(data?.message);
        }
      },
      error: (err) => {
        console.log(err);
        $("#wait-list-post")
          .attr("value", "Join now")
          .removeAttr("disabled")
          .removeClass("disable");
      },
    });
  };

  $(function () {

    //youtube_link();

    $("#join-now-form").submit((e) => {
      e.preventDefault();
      let [name, email, phone, school, role] = [
        $("#name").val().toLowerCase(),
        $("#email").val().toLowerCase(),
        $("#phone").val().toLowerCase(),
        $("#school").val().toLowerCase(),
        $("#role").val().toLowerCase(),
      ];
      let status = !empty(name) && !empty(email) && !empty(phone) && !empty(school) && !empty(role);
      if (status) {
        var formData = new FormData();
        formData.append("name", $("#name").val());
        formData.append("email", $("#email").val());
        formData.append("role", $("#role").val());
        formData.append("phone", $("#phone").val());
        formData.append("school", $("#school").val());
        formData.append("new_member",true);
        handle_wait_list(formData);
      } else {
        notification.danger("Must fill all fields");
      }
    });
  });

  function empty(str) {
    return !str.trim();
  }
</script>
