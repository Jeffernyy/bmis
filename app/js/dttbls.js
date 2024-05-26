$(function () {
  /* tblofficials */
  $("#tblofficials")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 7] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblofficials_wrapper .col-md-6:eq(0)");

  /* tblresident */
  $("#tblresident")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 1, 7] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblresident_wrapper .col-md-6:eq(0)");

  /* tblresident1 */
  $("#tblresident1")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 6] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblresident1_wrapper .col-md-6:eq(0)");

  /* tblcaptain */
  $("#tblcaptain")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 1, 6] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblcaptain_wrapper .col-md-6:eq(0)");

  /* tblstaff */
  $("#tblstaff")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 1, 6] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblstaff_wrapper .col-md-6:eq(0)");

  /* tblofficers */
  $("#tblofficers")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 5] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblofficers_wrapper .col-md-6:eq(0)");

  /* tblpurpose */
  $("#tblpurpose")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 1] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblpurpose_wrapper .col-md-6:eq(0)");

  /* tblgovoffice */
  $("#tblgovoffice")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 1] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblgovoffice_wrapper .col-md-6:eq(0)");

  /* tblblotter */
  $("#tblblotter")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 7] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblblotter_wrapper .col-md-6:eq(0)");

  /* tblhousehold */
  $("#tblhousehold")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: false, aTargets: [0, 5] },
        { orderable: false, targets: 0 },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tblhousehold_wrapper .col-md-6:eq(0)");

  /* tbllogs */
  $("#tbllogs")
    .DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      aoColumnDefs: [
        { bSortable: true, aTargets: [0, 2] },
        { orderable: true, targets: [0, 2] },
      ],
      aaSorting: [],
    })
    .buttons()
    .container()
    .appendTo("#tbllogs_wrapper .col-md-6:eq(0)");
});
