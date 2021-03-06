$(document).on("click", ".common_dialog", function () {
  $gourl = $(this).attr("gourl");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2] + $gourl;
  $.ajax({
    type: "POST",
    url: $url,
    success: function (data) {
      document.getElementById("display_dialog").innerHTML = data;
      allValidate();
    },
  });
});

$(document).on("keyup", "#domain_search", function () {
  $("#" + $(this).attr("id") + "_error").remove();
  $("#" + $(this).attr("id") + "_result").remove();
  $("#domain_checker_btn").attr("disabled", true);
});
$(document).on("focusout", "#domain_search", function () {
  $domain = $(this).val();
  $this = $(this);
  domainChecker($domain, $this);
});

function domainChecker($domain, $this) {
  if ($domain == null || $domain == "") {
    return;
  }
  $regex = /^([a-zA-Z0-9_.+-])+(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  $("#" + $this.attr("id") + "_error").remove();
  $("#" + $this.attr("id") + "_result").remove();
  if (!$regex.test($domain)) {
    $this.after(
      '<span class="error" id="' +
        $this.attr("id") +
        '_error">Invalid Domain Format</span>'
    );
    $("#domain_checker_btn").attr("disabled", true);
    return;
  }
  $gourl = "domainChecker";
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $.ajax({
    type: "POST",
    url: $url + "/" + $gourl,
    dataType: "JSON",
    data: { domain: $domain },
    beforeSend: function () {
      $this.after(
        '<span id="' +
          $this.attr("id") +
          '_result" class="text-primary">Loading......</span>'
      );
    },
    success: function (data) {
      $("#" + $this.attr("id") + "_result").remove();
      $result = $domain + " is avaliable";
      $class = "text-success";
      if (data.status) {
        $result = $domain + " is not avaliable";
        $class = "text-danger";
      }
      $this.after(
        '<span id="' +
          $this.attr("id") +
          '_result" class="' +
          $class +
          '">' +
          $result +
          "</span>"
      );
      $("#domain_checker_btn").attr("disabled", data.status);
    },
  });
}

$(document).on("change", "#full_control", function () {
  //"select all" change
  var status = this.checked; // "select all" checked status
  $(".permission").each(function () {
    //iterate all listed checkbox items
    this.checked = status; //change ".checkbox" checked status
  });
});

$(document).on("change", ".permission", function () {
  //".checkbox" change
  //uncheck "select all", if one of the listed checkbox item is unchecked
  if (this.checked == false) {
    //if this item is unchecked
    $("#full_control")[0].checked = false; //change "select all" checked status to false
  }

  //check "select all" if all checkbox items are checked
  if ($(".permission:checked").length == $(".permission").length) {
    $("#full_control")[0].checked = true; //change "select all" checked status to true
  }
});

$(document).on("change", ".app", function () {
  $gourl = $(this).attr("gourl");
  $app = $(this).val();
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $.ajax({
    type: "POST",
    url: $url + "/" + $gourl,
    data: { app: $app },
    success: function (data) {
      $("#version").html(data);
    },
  });
});

$(document).on("click", "#web_config_btn", function () {
  $gourl = $(this).attr("gourl");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  // $formdata = new FormData($('#web_config_fm')[0]);
  $formdata = $("#webconfig").val();
  $.ajax({
    type: "POST",
    url: $url + $gourl,
    // data:  $formdata,
    // cache : false,
    // processData: false,
    data: { web_config: $formdata },
    success: function (data) {
      // alert(data);
      // console.log(data)
      $("#webconfig_").html(data);
    },
  });
});

$(document).on("click", "#php_ini_btn", function () {
  $gourl = $(this).attr("gourl");
  $url = document.URL.split("/");
  $url = $url[0] + "//" + $url[2];
  $url = $url + $gourl;
  console.log($url);
  // $formdata = new FormData($('#php_ini_fm')[0]);
  $formdata = $("#phpini").val();
  $.ajax({
    type: "POST",
    url: $url,
    data: { php_ini: $formdata },
    // cache : false,
    // processData: false,
    success: function (data) {
      // alert(data);
      // console.log(data)
      $("#phpini_").html(data);
    },
  });
});
