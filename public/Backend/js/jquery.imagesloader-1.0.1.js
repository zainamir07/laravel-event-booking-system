//  Image Uploading Javascript 
$(document).ready(function () {
  var auctionImages = null;
  var imagesloader = $('[data-type=imagesloader]').imagesloader({
    maxFiles: 8,
    minSelect: 1,
    imagesToLoad: auctionImages
  });
  $frm = $('#frm');
  $frm.submit(function (e) {
    var $form = $(this);
    var files = imagesloader.data('format.imagesloader').AttachmentArray;
    var il = imagesloader.data('format.imagesloader');
    if (il.CheckValidity())
      alert('Upload ' + files.length + ' files');
    e.preventDefault();
    e.stopPropagation();
  });
});

if ("undefined" == typeof jQuery) throw Error("Images loader requires jQuery");
function base64ToArrayBuffer(t) {
    for (var e = window.atob(t), a = e.length, i = new Uint8Array(a), r = 0; r < a; r++) i[r] = e.charCodeAt(r);
    return i.buffer;
}
function arrayBufferToBase64(t) {
    for (var e = "", a = new Uint8Array(t), i = a.byteLength, r = 0; r < i; r++) e += String.fromCharCode(a[r]);
    return window.btoa(e);
}
function getOrientation(t) {
    var e = new DataView(t);
    if (65496 != e.getUint16(0, !1)) return -2;
    for (var a = e.byteLength, i = 2; i < a; ) {
        e.getUint16(i + 2, !1);
        var r = e.getUint16(i, !1);
        if (((i += 2), 65505 == r)) {
            if (1165519206 != e.getUint32((i += 2), !1)) return -1;
            var n = 18761 == e.getUint16((i += 6), !1);
            i += e.getUint32(i + 4, n);
            var o = e.getUint16(i, n);
            i += 2;
            for (var d = 0; d < o; d++) if (274 == e.getUint16(i + 12 * d, n)) return e.getUint16(i + 12 * d + 8, n);
        } else if ((65280 & r) != 65280) break;
        else i += e.getUint16(i, !1);
    }
    return -1;
}
function imageToFormat(t, e = null, a = null, i = "image/jpeg", r = 0.9, n = -1) {
    var o = document.createElement("canvas"),
        d = t.width,
        s = t.height;
    t.width > e && (d = e), t.height > a && (s = e), (o.width = t.width), (o.height = t.height), n >= 5 && n <= 8 && ((o.width = t.height), (o.height = t.width));
    var l = d / t.width,
        m = s / t.height,
        h = 1;
    l < h && (h = l), m < h && (h = m), (o.width *= h), (o.height *= h);
    var f = o.getContext("2d");
    switch ((f.scale(h, h), n)) {
        case 1:
            f.transform(1, 0, 0, 1, 0, 0);
            break;
        case 2:
            f.transform(-1, 0, 0, 1, t.width, 0);
            break;
        case 3:
            f.transform(-1, 0, 0, -1, t.width, t.height);
            break;
        case 4:
            f.transform(1, 0, 0, -1, 0, t.height);
            break;
        case 5:
            f.transform(0, 1, 1, 0, 0, 0);
            break;
        case 6:
            f.transform(0, 1, -1, 0, t.height, 0);
            break;
        case 7:
            f.transform(0, -1, -1, 0, t.height, t.width);
            break;
        case 8:
            f.transform(0, -1, 1, 0, 0, t.width);
    }
    return f.drawImage(t, 0, 0), o.toDataURL(i, r);
}
function drawRotated(t, e) {
    var a = document.createElement("canvas"),
        i = a.getContext("2d"),
        r = t.width,
        n = t.height,
        o = 0,
        d = 0;
    switch (e) {
        case -90:
        case 270:
            (r = t.height), (n = t.width), (o = -1 * t.width);
            break;
        case 90:
            (r = t.height), (n = t.width), (d = -1 * t.height);
            break;
        case 180:
            (o = -1 * t.width), (d = -1 * t.height);
    }
    return a.setAttribute("width", r), a.setAttribute("height", n), i.rotate((e * Math.PI) / 180), i.drawImage(t, o, d), a.toDataURL();
}
(String.prototype.replaceAll = function (t, e) {
    var a = this;
    return a.replace(RegExp(t, "g"), e);
}),
    ($.fn.imageToFormat = function () {
        return this.each(function () {
            this.src = imageToFormat(this);
        });
    }),
    (function ($) {
        "use strict";
        var ImagesLoader = function (t, e, a) {
            (this.name = t), (this.element = e), (this.$element = $(e)), (this.inProgress = !1);
            var i = this.path() + "img/";
            (this.options = $.extend({ iconBasePath: i }, ImagesLoader.DEFAULTS, a, this.$element.data())), (this.enabled = !0), this.init();
        };
        (ImagesLoader.DEFAULTS = {
            fadeTime: "slow",
            inputID: "files",
            maxfiles: 4,
            maxSize: 512e4,
            minSelect: 1,
            imagesToLoad: null,
            filesType: ["image/jpeg", "image/png", "image/gif"],
            maxWidth: 1280,
            maxHeight: 1024,
            imgType: "image/jpeg",
            imgQuality: 0.9,
            errorformat: "Accepted format",
            errorsize: "Max size allowed",
            errorduplicate: "File already uploaded",
            errormaxfiles: "Max images you can upload",
            errorminfiles: "Minimum number of images to upload",
            modifyimagetext: "Modify image",
            rotation: 90,
        }),
            (ImagesLoader.prototype.fullPath = function () {
                return $("script[src*='" + imagesloader_fileName + "']").attr("src");
            }),
            (ImagesLoader.prototype.path = function () {
                var t = this.fullPath();
                return t.substr(0, t.lastIndexOf("/") + 1);
            }),
            (ImagesLoader.prototype.fileName = function () {
                var t = this.fullPath();
                return t.substr(t.lastIndexOf("/") + 1, t.length);
            }),
            (ImagesLoader.prototype.btnAddClick = function (t, e) {
                var a = this;
                $(a.element), a.options, a.$files.click();
            }),
            (ImagesLoader.prototype.btnChangeClick = function (t, e) {
                var a = this;
                $(a.element);
                var i = a.options;
                if (t.target.files) {
                    var r = t.target.files,
                        n = a.AttachmentArray.length + t.target.files.length;
                    a.$progress.hide(), n > i.maxfiles && a.ShowProgress(a.barStyle.warning, i.errormaxfiles + ": " + i.maxfiles, 2e3);
                    var o = a.$addImage.find('[data-type="loading"]');
                    o.show(),
                        (function t(e) {
                            if (e >= r.length) {
                                a.AttachmentArray.length >= i.maxfiles && a.$addImage.hide(), o.hide();
                                return;
                            }
                            let n = r[e];
                            if (!1 == a.ApplyFileValidationRules(n)) {
                                t(++e);
                                return;
                            }
                            a.AttachmentArray.push({ AttachmentType: 1, ObjectType: 1, FileName: n.name, FileDescription: "Attachment", NoteText: "", MimeType: n.type, Base64: null, Orientation: -1, FileSizeInBytes: n.size, File: n });
                            var d = new FileReader();
                            (d.onload = function (r) {
                                var o = 1 == a.AttachmentArray.length,
                                    d = a.AttachmentArray.map(function (t) {
                                        return t.FileName;
                                    }).indexOf(n.name),
                                    s = r.target.result,
                                    l = new Image();
                                (l.crossOrigin = "anonymous"),
                                    (l.onload = function () {
                                        var r = getOrientation(base64ToArrayBuffer(this.src.split("base64,")[1])),
                                            s = imageToFormat(this, i.maxWidth, i.maxHeight, i.imgType, i.imgQuality, r);
                                        a.RenderThumbnail(s, n.name, o), (a.AttachmentArray[d].Base64 = s.split("base64,")[1]), (a.AttachmentArray[d].Orientation = r), t(++e);
                                    }),
                                    (l.src = s);
                            }),
                                d.readAsDataURL(n);
                        })(0);
                }
            }),
            (ImagesLoader.prototype.btnRemoveClick = function (t, e) {
                var a = this;
                $(a.element);
                var i = a.options,
                    r = $(e).closest('[data-type="image"]');
                r.find('[data-type="btn-modify"]').popover("hide");
                var n = r.data("id");
                if (a.AttachmentArray.length > 1 && a.AttachmentArray[0].FileName == r.data("id")) {
                    var o = r.next('[data-type="image"]'),
                        d = o.find('[data-type="noimage"]'),
                        s = o.find('[data-type="preview"]'),
                        l = o.find('[data-type="add"]');
                    o.find('[data-type="btn-modify"]');
                    var m = o.find('[data-type="remove"]');
                    o.find('[data-type="main"]'), o.find('[data-type="image-ratio-box"]').find(".main-tag"), m.show(), d.hide(), l.hide(), s.fadeIn(i.fadeTime);
                }
                var h = a.AttachmentArray.map(function (t) {
                    return t.FileName;
                }).indexOf(n);
                -1 !== h && a.AttachmentArray.splice(h, 1),
                    a.$addImage.fadeOut(i.fadeTime),
                    r.fadeOut(i.fadeTime, function () {
                        r.remove(), a.$addImage.closest('[data-type="image"]').attr("data-type", "noimage"), a.$addImage.fadeIn(i.fadeTime);
                    }),
                    a.$progress.fadeOut(i.fadeTime);
            }),
            (ImagesLoader.prototype.btnMainClick = function (t, e) {
                var a = this,
                    i = $(a.element),
                    r = a.options,
                    n = $(e).closest('[data-type="image"]'),
                    o = n.find('[data-type="preview"]'),
                    d = n.find('[data-type="image-ratio-box"]'),
                    s = d.attr("data-original-title"),
                    l = n.attr("data-id"),
                    m = o.attr("src");
                n.find('[data-type="btn-modify"]').popover("hide");
                var h = a.AttachmentArray[0],
                    f = i.find('[data-id="' + h.FileName + '"]'),
                    p = f.find('[data-type="preview"]'),
                    c = f.find('[data-type="image-ratio-box"]'),
                    g = c.find(".main-tag"),
                    u = c.attr("data-original-title"),
                    y = p.attr("src");
                g.hide(),
                    o.fadeOut(r.fadeTime, function () {
                        o.attr("src", y);
                    }),
                    p.fadeOut(r.fadeTime, function () {
                        p.attr("src", m), g.show();
                    }),
                    o.fadeIn(r.fadeTime),
                    p.fadeIn(r.fadeTime),
                    n.attr("data-id", h.FileName),
                    f.attr("data-id", l),
                    d.attr("data-original-title", u),
                    c.attr("data-original-title", s);
                var b = a.AttachmentArray.map(function (t) {
                    return t.FileName;
                }).indexOf(l);
                -1 !== b && ((a.AttachmentArray[0] = a.AttachmentArray[b]), (a.AttachmentArray[b] = h));
            }),
            (ImagesLoader.prototype.btnLeftClick = function (t, e) {
                var a = this,
                    i = $(a.element),
                    r = a.options,
                    n = $(e).closest('[data-type="image"]'),
                    o = n.find('[data-type="preview"]'),
                    d = n.find('[data-type="image-ratio-box"]'),
                    s = d.attr("data-original-title"),
                    l = n.attr("data-id");
                n.find('[data-type="btn-modify"]').popover("hide");
                var m = a.AttachmentArray.map(function (t) {
                        return t.FileName;
                    }).indexOf(l),
                    h = m - 1,
                    f = a.AttachmentArray[h],
                    p = i.find('[data-id="' + f.FileName + '"]'),
                    c = p.find('[data-type="preview"]'),
                    g = p.find('[data-type="image-ratio-box"]'),
                    u = g.attr("data-original-title"),
                    y = "data:image/jpeg;base64," + a.AttachmentArray[m].Base64,
                    b = "data:image/jpeg;base64," + f.Base64,
                    v = g.find(".main-tag");
                v.hide(),
                    o.fadeOut(r.fadeTime, function () {
                        o.attr("src", b);
                    }),
                    c.fadeOut(r.fadeTime, function () {
                        c.attr("src", y), 0 == h && v.show();
                    }),
                    o.fadeIn(r.fadeTime),
                    c.fadeIn(r.fadeTime),
                    d.attr("data-original-title", u),
                    g.attr("data-original-title", s),
                    n.attr("data-id", f.FileName),
                    p.attr("data-id", l),
                    -1 !== m && ((a.AttachmentArray[h] = a.AttachmentArray[m]), (a.AttachmentArray[m] = f));
            }),
            (ImagesLoader.prototype.btnRightClick = function (t, e) {
                var a = this,
                    i = $(a.element),
                    r = a.options,
                    n = $(e).closest('[data-type="image"]'),
                    o = n.find('[data-type="preview"]'),
                    d = n.find('[data-type="image-ratio-box"]'),
                    s = d.attr("data-original-title"),
                    l = n.attr("data-id");
                n.find('[data-type="btn-modify"]').popover("hide");
                var m = a.AttachmentArray.map(function (t) {
                        return t.FileName;
                    }).indexOf(l),
                    h = m + 1,
                    f = a.AttachmentArray[h],
                    p = i.find('[data-id="' + f.FileName + '"]'),
                    c = p.find('[data-type="preview"]'),
                    g = p.find('[data-type="image-ratio-box"]'),
                    u = g.attr("data-original-title"),
                    y = "data:image/jpeg;base64," + a.AttachmentArray[m].Base64,
                    b = "data:image/jpeg;base64," + f.Base64;
                d.find(".main-tag").hide(),
                    o.fadeOut(r.fadeTime, function () {
                        o.attr("src", b);
                    }),
                    c.fadeOut(r.fadeTime, function () {
                        c.attr("src", y);
                    }),
                    o.fadeIn(r.fadeTime),
                    c.fadeIn(r.fadeTime),
                    d.attr("data-original-title", u),
                    g.attr("data-original-title", s),
                    n.attr("data-id", f.FileName),
                    p.attr("data-id", l),
                    -1 !== m && ((a.AttachmentArray[h] = a.AttachmentArray[m]), (a.AttachmentArray[m] = f));
            }),
            (ImagesLoader.prototype.btnRotateClick = function (t, e) {
                var a = this,
                    i = a.options;
                $(a.element);
                var r = $(e).closest('[data-type="image"]'),
                    n = r.find('[data-type="preview"]'),
                    o = r.attr("data-id"),
                    d = a.AttachmentArray.map(function (t) {
                        return t.FileName;
                    }).indexOf(o),
                    s = new Image();
                (s.src = "data:image/jpeg;base64," + a.AttachmentArray[d].Base64),
                    (s.onload = function () {
                        var t = drawRotated(this, i.rotation),
                            e = t.split("base64,")[1];
                        n.attr("src", t), (a.AttachmentArray[d].Base64 = e);
                    });
            }),
            (ImagesLoader.prototype.ShowProgress = function (t, e, a = 0) {
                var i = this,
                    r = i.options;
                (!i.$progress.is(":visible") || i.$progressbar.text() !== e) &&
                    (i.$progressbar.removeClass(), i.$progressbar.addClass(t.class), i.$progressbar.attr("style", t.style), i.$progressbar.text(e), i.$progress.hide().fadeIn(r.fadeTime), a > 0 && i.$progress.delay(a).fadeOut(r.fadeTime));
            }),
            (ImagesLoader.prototype.execJsFunction = function () {
                var self = this,
                    options = self.options;
                null != this.jsFunction && eval(this.jsFunction);
            }),
            (ImagesLoader.prototype.ApplyFileValidationRules = function (t) {
                var e = this;
                $(e.element);
                var a = e.options;
                return !1 == e.CheckFileUnique(t.name)
                    ? (e.ShowProgress(e.barStyle.danger, a.errorduplicate + " (" + t.name + ")"), !1)
                    : !1 == e.CheckFileType(t.type)
                    ? (e.ShowProgress(e.barStyle.danger, a.errorformat + ": " + a.filesType.toString().replaceAll(",", ", ") + " (" + t.name + ")"), !1)
                    : !1 == e.CheckFileSize(t.size)
                    ? (e.ShowProgress(e.barStyle.danger, a.errorsize + " " + a.maxSize / 1e3 + " Kb (" + t.name + ")"), !1)
                    : !1 != e.CheckFilesCount();
            }),
            (ImagesLoader.prototype.CheckFileType = function (t) {
                var e = this;
                return $(e.element), -1 != e.options.filesType.indexOf(t);
            }),
            (ImagesLoader.prototype.CheckFileSize = function (t) {
                var e = this;
                return $(e.element), t < e.options.maxSize;
            }),
            (ImagesLoader.prototype.CheckFilesCount = function () {
                var t = this;
                $(t.element);
                var e = t.options;
                return t.AttachmentArray.length < e.maxfiles;
            }),
            (ImagesLoader.prototype.CheckFileUnique = function (t) {
                var e = this;
                $(e.element), e.options;
                for (var a = 0; a < e.AttachmentArray.length; a++) if (e.AttachmentArray[a].FileName == t) return !1;
                return !0;
            }),
            (ImagesLoader.prototype.CheckValidity = function () {
                var t = this;
                $(t.element);
                var e = t.options,
                    a = !0;
                return t.AttachmentArray.length < e.minSelect && (t.ShowProgress(t.barStyle.danger, e.errorminfiles + ": " + e.minSelect), (a = !1)), a;
            }),
            (ImagesLoader.prototype.LoadImages = function () {
                var t = this;
                $(t.element);
                var e = t.options;
                !(function a(i) {
                    if (!(i >= t.imagesToLoad.length)) {
                        var r = t.imagesToLoad[i].Url,
                            n = r.substring(r.lastIndexOf("/") + 1),
                            o = 0 == i,
                            n = escape(r.substring(r.lastIndexOf("/") + 1)),
                            d = new Image();
                        (d.crossOrigin = "anonymous"),
                            (d.onload = function () {
                                var d = imageToFormat(this, e.maxWidth, e.maxHeight, e.imgType, e.imgQuality).split("base64,")[1];
                                t.AttachmentArray.push({ AttachmentType: 1, ObjectType: 1, FileName: n, FileDescription: "Attachment", NoteText: "", MimeType: e.imgType, Base64: d, FileSizeInBytes: d.length, File: null }),
                                    t.RenderThumbnail(r, n, o, !0),
                                    a(++i);
                            }),
                            (d.src = r);
                    }
                })(0);
            }),
            (ImagesLoader.prototype.RenderThumbnail = function (t, e, a = !1, i = !1) {
                var r = this,
                    n = $(r.element),
                    o = r.options,
                    d = r.$model.clone(!0, !0);
                d.attr("data-type", "image"), d.attr("data-id", e);
                var s = d.find('[data-type="noimage"]'),
                    l = d.find('[data-type="preview"]');
                l.attr("src", t);
                var m = d.find('[data-type="add"]');
                let h = d.find('[data-type="btn-modify"]');
                d.find('[data-type="remove"]'), d.find('[data-type="main"]'), d.find('[data-type="left"]'), d.find('[data-type="right"]');
                var f = d.find('[data-type="image-ratio-box"]');
                return (
                    f.attr("data-toggle", "tooltip"),
                    f.attr("data-placement", "top"),
                    i ? f.attr("title", t.substring(t.indexOf("_") + 1)) : f.attr("title", decodeURI(e)),
                    a && f.find(".main-tag").show(),
                    h.fadeIn(o.fadeTime),
                    h
                        .popover({
                            html: !0,
                            trigger: "manual",
                            title: function () {
                                return "<p class='m-0 p-0' style='text-align:center'>" + o.modifyimagetext + "</p>";
                            },
                            content: function () {
                                var t = n.find('[data-type="popover"]').first().clone(!0, !0),
                                    e = h.closest('[data-type="image"]').attr("data-id"),
                                    a = r.AttachmentArray.map(function (t) {
                                        return t.FileName;
                                    }).indexOf(e);
                                return (
                                    0 == a &&
                                        ($(t).find('[data-operation="left"]').addClass("disabled"),
                                        $(t).find('[data-operation="left"]').css("cursor", "default"),
                                        $(t).find('[data-operation="left"]').removeAttr("data-operation"),
                                        $(t).find('[data-operation="main"]').addClass("disabled"),
                                        $(t).find('[data-operation="main"]').css("cursor", "default"),
                                        $(t).find('[data-operation="main"]').removeAttr("data-operation")),
                                    a == r.AttachmentArray.length - 1 &&
                                        ($(t).find('[data-operation="right"]').addClass("disabled"), $(t).find('[data-operation="right"]').css("cursor", "default"), $(t).find('[data-operation="right"]').removeAttr("data-operation")),
                                    $(t)
                                        .find("[data-operation]")
                                        .click(function () {
                                            h.parent().trigger($(this).data("operation"));
                                        }),
                                    t
                                );
                            },
                        })
                        .on("click", function () {
                            n.find("[data-toggle=popover]").not(this).popover("hide");
                            var t = this,
                                e = $(t);
                            e.popover("show"),
                                $(".popover").on("mouseleave", function () {
                                    e.popover("hide");
                                });
                        }),
                    f.tooltip(),
                    s.hide(),
                    m.hide(),
                    d.insertBefore(r.$addImage),
                    d.show(),
                    l.fadeIn(o.fadeTime),
                    d
                );
            }),
            (ImagesLoader.prototype.hideTooltip = function () {
                var t = this;
                t.options, t.$element.find('[data-toggle="tooltip"]').tooltip("hide");
            }),
            (ImagesLoader.prototype.initTooltip = function (t) {
                var e = this;
                e.options,
                    $(t)
                        .find('[data-toggle="tooltip"]')
                        .tooltip({ delay: { show: 200, hide: 0 }, trigger: "hover" });
            }),
            (ImagesLoader.prototype.init = function () {
                var t = this,
                    e = this.options,
                    a = $(this.element);
                (this.AttachmentArray = []),
                    (this.jsFunction = e.jsFunction),
                    (this.$model = a.find('[data-type="image-model"]')),
                    this.$model.bind("remove", function (e) {
                        t.btnRemoveClick(e, this);
                    }),
                    this.$model.bind("main", function (e) {
                        t.btnMainClick(e, this);
                    }),
                    this.$model.bind("left", function (e) {
                        t.btnLeftClick(e, this);
                    }),
                    this.$model.bind("right", function (e) {
                        t.btnRightClick(e, this);
                    }),
                    this.$model.bind("rotateclockwise", function (a) {
                        (e.rotation = 90), t.btnRotateClick(a, this);
                    }),
                    this.$model.bind("rotateanticlockwise", function (a) {
                        (e.rotation = -90), t.btnRotateClick(a, this);
                    }),
                    (this.$btnAdd = a.find('[data-type="add"]')),
                    this.$btnAdd.click(function (e) {
                        t.btnAddClick(e, this);
                    }),
                    (this.$noImage = a.find('[data-type="noimage"]')),
                    this.$noImage.click(function (e) {
                        t.btnAddClick(e, this);
                    }),
                    (this.$btnRemove = a.find('[data-type="remove"]')),
                    this.$btnRemove.click(function (e) {
                        t.btnRemoveClick(e, this);
                    }),
                    (this.imagesToLoad = e.imagesToLoad),
                    (this.$files = $("#" + e.inputID)),
                    this.$files.bind("change", function (e) {
                        t.btnChangeClick(e, this);
                    }),
                    (this.$progress = a.find('[data-type="progress"]').first()),
                    (this.$progressbar = a.find('[data-type="progressBar"]').first()),
                    (this.barStyle = {
                        successStriped: { class: "progress-bar progress-bar-striped progress-bar-animated bg-success", style: "width: 100%" },
                        warning: { class: "progress-bar progress-bar-striped progress-bar-animated bg-warning", style: "width: 100%; color: #5a5a5a" },
                        success: { class: "progress-bar bg-success", style: "width: 100%" },
                        danger: { class: "progress-bar bg-danger", style: "width: 100%" },
                    }),
                    (this.$addImage = this.$model.clone(!0, !0)),
                    this.$addImage.attr("data-type", "image-add"),
                    this.$addImage.appendTo(a),
                    null != this.imagesToLoad && this.LoadImages(),
                    (null == this.imagesToLoad || this.imagesToLoad.length < this.options.maxfiles) && this.$addImage.show();
            });
        var imagesloader_version = "1.0.1",
            imagesloader_pluginName = "format.imagesloader",
            imagesloader_fileName = "jquery.imagesloader",
            old = $.fn.imagesloader;
        ($.fn.imagesloader = function (t) {
            return (
                $.fn.imagesloader.loadCSS(),
                this.each(function () {
                    var e = $(this),
                        a = e.data(imagesloader_pluginName),
                        i = "object" == typeof t && t;
                    if (!a) {
                        if ("destroy" == t) return;
                        (this.plugin = new ImagesLoader(imagesloader_pluginName, this, i)), e.data(imagesloader_pluginName, this.plugin);
                    }
                    "string" == typeof t && a[t]();
                })
            );
        }),
            ($.fn.imagesloader.loadCSS = function () {
                var t = $("script[src*='" + imagesloader_fileName + "']")
                    .attr("src")
                    .split("-")[0];
                if (0 == $("link[href*='" + imagesloader_fileName + "']").length) {
                    var e = $("<link rel='stylesheet' type='text/css' href='" + t + ".css'>");
                    $("head").append(e);
                }
            }),
            ($.fn.imagesloader.Constructor = ImagesLoader),
            ($.fn.imagesloader.noConflict = function () {
                return ($.fn.imagesloader = old), this;
            });
    })(jQuery);
