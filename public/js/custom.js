var AWN = function (t) {
    var e = {};

    function n(o) {
        if (e[o]) return e[o].exports;
        var i = e[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return t[o].call(i.exports, i, i.exports, n), i.l = !0, i.exports
    }
    return n.m = t, n.c = e, n.d = function (t, e, o) {
        n.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: o
        })
    }, n.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function (t, e) {
        if (1 & e && (t = n(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var o = Object.create(null);
        if (n.r(o), Object.defineProperty(o, "default", {
            enumerable: !0,
            value: t
        }), 2 & e && "string" != typeof t)
            for (var i in t) n.d(o, i, function (e) {
                return t[e]
            }.bind(null, i));
        return o
    }, n.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return n.d(e, "a", e), e
    }, n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, n.p = "", n(n.s = 0)
}([function (t, e, n) {
    t.exports = n(1).default
}, function (t, e, n) {
    "use strict";

    function o(t) {
        return (o = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        })(t)
    }

    function i(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }
    n.r(e);
    var r = {
        maxNotifications: 10,
        animationDuration: 300,
        position: "bottom-right",
        labels: {
            tip: "Tip",
            info: "Info",
            success: "Success",
            warning: "Attention",
            alert: "Error",
            async: "Loading",
            confirm: "Confirmation required",
            confirmOk: "OK",
            confirmCancel: "Cancel"
        },
        icons: {
            tip: "question-circle",
            info: "info-circle",
            success: "check-circle",
            warning: "exclamation-circle",
            alert: "exclamation-triangle",
            async: "cog fa-spin",
            confirm: "exclamation-triangle",
            prefix: "<i class='fa fas fa-fw fa-",
            suffix: "'></i>",
            enabled: !0
        },
        replacements: {
            tip: null,
            info: null,
            success: null,
            warning: null,
            alert: null,
            async: null,
            "async-block": null,
            modal: null,
            confirm: null,
            general: {
                "<script>": "",
                "<\/script>": ""
            }
        },
        messages: {
            tip: "",
            info: "",
            success: "Action has been succeeded",
            warning: "",
            alert: "Action has been failed",
            confirm: "This action can't be undone. Continue?",
            async: "Please, wait...",
            "async-block": "Loading"
        },
        formatError: function (t) {
            if (t.response) {
                if (!t.response.data) return "500 API Server Error";
                if (t.response.data.errors) return t.response.data.errors.map(function (t) {
                    return t.detail
                }).join("<br>");
                if (t.response.statusText) return "".concat(t.response.status, " ").concat(t.response.statusText, ": ").concat(t.response.data)
            }
            return t.message ? t.message : t
        },
        durations: {
            global: 5e3,
            success: null,
            info: null,
            tip: null,
            warning: null,
            alert: null
        },
        minDurations: {
            async: 1e3,
            "async-block": 1e3
        }
    },
        a = function () {
            function t() {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : r;
                ! function (t, e) {
                    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
                }(this, t), Object.assign(this, this.defaultsDeep(n, e))
            }
            var e, n, a;
            return e = t, (n = [{
                key: "icon",
                value: function (t) {
                    return this.icons.enabled ? "".concat(this.icons.prefix).concat(this.icons[t]).concat(this.icons.suffix) : ""
                }
            }, {
                key: "label",
                value: function (t) {
                    return this.labels[t]
                }
            }, {
                key: "duration",
                value: function (t) {
                    var e = this.durations[t];
                    return null === e ? this.durations.global : e
                }
            }, {
                key: "toSecs",
                value: function (t) {
                    return "".concat(t / 1e3, "s")
                }
            }, {
                key: "applyReplacements",
                value: function (t, e) {
                    if (!t) return this.messages[e] || "";
                    for (var n = 0, o = ["general", e]; n < o.length; n++) {
                        var i = o[n];
                        if (this.replacements[i])
                            for (var r in this.replacements[i]) t = t.replace(r, this.replacements[i][r])
                    }
                    return t
                }
            }, {
                key: "override",
                value: function (e) {
                    return e ? new t(e, this) : this
                }
            }, {
                key: "defaultsDeep",
                value: function (t, e) {
                    var n = {};
                    for (var i in t) e.hasOwnProperty(i) ? n[i] = "object" === o(t[i]) && null !== t[i] ? this.defaultsDeep(t[i], e[i]) : e[i] : n[i] = t[i];
                    return n
                }
            }]) && i(e.prototype, n), a && i(e, a), t
        }(),
        s = {
            popup: "".concat("awn", "-popup"),
            toast: "".concat("awn", "-toast"),
            btn: "".concat("awn", "-btn"),
            confirm: "".concat("awn", "-confirm")
        },
        c = {
            prefix: s.toast,
            klass: {
                label: "".concat(s.toast, "-label"),
                content: "".concat(s.toast, "-content"),
                icon: "".concat(s.toast, "-icon"),
                progressBar: "".concat(s.toast, "-progress-bar"),
                progressBarPause: "".concat(s.toast, "-progress-bar-paused")
            },
            ids: {
                container: "".concat(s.toast, "-container")
            }
        },
        u = {
            prefix: s.popup,
            klass: {
                buttons: "".concat("awn", "-buttons"),
                button: s.btn,
                successBtn: "".concat(s.btn, "-success"),
                cancelBtn: "".concat(s.btn, "-cancel"),
                title: "".concat(s.popup, "-title"),
                body: "".concat(s.popup, "-body"),
                content: "".concat(s.popup, "-content"),
                dotAnimation: "".concat(s.popup, "-loading-dots")
            },
            ids: {
                wrapper: "".concat(s.popup, "-wrapper"),
                confirmOk: "".concat(s.confirm, "-ok"),
                confirmCancel: "".concat(s.confirm, "-cancel")
            }
        },
        l = {
            klass: {
                hiding: "".concat("awn", "-hiding")
            },
            lib: "awn"
        };

    function f(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }
    var p = function () {
        function t(e, n, o, i, r) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.newNode = document.createElement("div"), n && (this.newNode.id = n), o && (this.newNode.className = o), i && (this.newNode.style.cssText = i), this.parent = e, this.options = r
        }
        var e, n, o;
        return e = t, (n = [{
            key: "beforeInsert",
            value: function () { }
        }, {
            key: "afterInsert",
            value: function () { }
        }, {
            key: "insert",
            value: function () {
                return this.beforeInsert(), this.el = this.parent.appendChild(this.newNode), this.afterInsert(), this
            }
        }, {
            key: "replace",
            value: function (t) {
                var e = this;
                if (this.getElement()) return this.beforeDelete().then(function () {
                    return e.updateType(t.type), e.parent.replaceChild(t.newNode, e.el), e.el = e.getElement(t.newNode), e.afterInsert(), e
                })
            }
        }, {
            key: "beforeDelete",
            value: function () {
                var t = this,
                    e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.el,
                    n = 0;
                return this.start && (n = this.options.minDurations[this.type] + this.start - Date.now()) < 0 && (n = 0), new Promise(function (o) {
                    setTimeout(function () {
                        e.classList.add(l.klass.hiding), setTimeout(o, t.options.animationDuration)
                    }, n)
                })
            }
        }, {
            key: "delete",
            value: function () {
                var t = this,
                    e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.el;
                return this.getElement(e) ? this.beforeDelete(e).then(function () {
                    e.remove(), t.afterDelete()
                }) : null
            }
        }, {
            key: "afterDelete",
            value: function () { }
        }, {
            key: "getElement",
            value: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.el;
                return document.getElementById(t.id)
            }
        }, {
            key: "addEvent",
            value: function (t, e) {
                this.el.addEventListener(t, e)
            }
        }, {
            key: "toggleClass",
            value: function (t) {
                this.el.classList.toggle(t)
            }
        }, {
            key: "updateType",
            value: function (t) {
                this.type = t, this.duration = this.options.duration(this.type)
            }
        }]) && f(e.prototype, n), o && f(e, o), t
    }();

    function d(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }
    var y = function () {
        function t(e, n) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.callback = e, this.remaining = n, this.resume()
        }
        var e, n, o;
        return e = t, (n = [{
            key: "pause",
            value: function () {
                this.paused = !0, window.clearTimeout(this.timerId), this.remaining -= new Date - this.start
            }
        }, {
            key: "resume",
            value: function () {
                var t = this;
                this.paused = !1, this.start = new Date, window.clearTimeout(this.timerId), this.timerId = window.setTimeout(function () {
                    window.clearTimeout(t.timerId), t.callback()
                }, this.remaining)
            }
        }, {
            key: "toggle",
            value: function () {
                this.paused ? this.resume() : this.pause()
            }
        }]) && d(e.prototype, n), o && d(e, o), t
    }();

    function h(t) {
        return (h = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        })(t)
    }

    function m(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }

    function v(t, e) {
        return !e || "object" !== h(e) && "function" != typeof e ? function (t) {
            if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return t
        }(t) : e
    }

    function b(t) {
        return (b = Object.setPrototypeOf ? Object.getPrototypeOf : function (t) {
            return t.__proto__ || Object.getPrototypeOf(t)
        })(t)
    }

    function k(t, e) {
        return (k = Object.setPrototypeOf || function (t, e) {
            return t.__proto__ = e, t
        })(t, e)
    }
    var g = function (t) {
        function e(t, n, o, i) {
            var r;
            return function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e), (r = v(this, b(e).call(this, i, "".concat(c.prefix, "-").concat(Math.floor(Date.now() - 100 * Math.random())), "".concat(c.prefix, " ").concat(c.prefix, "-").concat(n), "animation-duration: ".concat(o.toSecs(o.animationDuration), ";"), o))).updateType(n), r.setInnerHtml(t), r
        }
        var n, o, i;
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function");
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    writable: !0,
                    configurable: !0
                }
            }), e && k(t, e)
        }(e, p), n = e, (o = [{
            key: "setInnerHtml",
            value: function (t) {
                "alert" === this.type && t && (t = this.options.formatError(t)), t = this.options.applyReplacements(t, this.type), this.newNode.innerHTML = '<div class="awn-toast-wrapper">'.concat(this.progressBar).concat(this.label, '<div class="').concat(c.klass.content, '">').concat(t, '</div><span class="').concat(c.klass.icon, '">').concat(this.options.icon(this.type), "</span></div>")
            }
        }, {
            key: "beforeInsert",
            value: function () {
                var t = this;
                if (this.parent.childElementCount >= this.options.maxNotifications) {
                    var e = Array.from(this.parent.getElementsByClassName(c.prefix));
                    this.delete(e.find(function (e) {
                        return !t.isDeleted(e)
                    }))
                }
            }
        }, {
            key: "afterInsert",
            value: function () {
                var t = this;
                if ("async" == this.type) return this.start = Date.now();
                if (this.addEvent("click", function () {
                    return t.delete()
                }), !(this.duration <= 0)) {
                    this.timer = new y(function () {
                        return t.delete()
                    }, this.duration);
                    for (var e = 0, n = ["mouseenter", "mouseleave"]; e < n.length; e++) {
                        var o = n[e];
                        this.addEvent(o, function () {
                            t.isDeleted() || (t.toggleClass(c.klass.progressBarPause), t.timer.toggle())
                        })
                    }
                }
            }
        }, {
            key: "isDeleted",
            value: function () {
                return (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : this.el).classList.contains(l.klass.hiding)
            }
        }, {
            key: "progressBar",
            get: function () {
                return this.duration <= 0 || "async" === this.type ? "" : "<div class='".concat(c.klass.progressBar, "' style=\"animation-duration:").concat(this.options.toSecs(this.duration), ';"></div>')
            }
        }, {
            key: "label",
            get: function () {
                return '<b class="'.concat(c.klass.label, '">').concat(this.options.label(this.type), "</b>")
            }
        }]) && m(n.prototype, o), i && m(n, i), e
    }();

    function w(t) {
        return (w = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        })(t)
    }

    function O(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }

    function _(t, e) {
        return !e || "object" !== w(e) && "function" != typeof e ? function (t) {
            if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
            return t
        }(t) : e
    }

    function T(t) {
        return (T = Object.setPrototypeOf ? Object.getPrototypeOf : function (t) {
            return t.__proto__ || Object.getPrototypeOf(t)
        })(t)
    }

    function E(t, e) {
        return (E = Object.setPrototypeOf || function (t, e) {
            return t.__proto__ = e, t
        })(t, e)
    }
    var S = function (t) {
        function e(t) {
            var n, o = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "modal",
                i = arguments.length > 2 ? arguments[2] : void 0,
                r = arguments.length > 3 ? arguments[3] : void 0,
                a = arguments.length > 4 ? arguments[4] : void 0;
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            var s = "animation-duration: ".concat(i.toSecs(i.animationDuration), ";");
            return (n = _(this, T(e).call(this, document.body, u.ids.wrapper, null, s, i)))[u.ids.confirmOk] = r, n[u.ids.confirmCancel] = a, n.className = "".concat(u.prefix, "-").concat(o), ["confirm", "async-block", "modal"].includes(o) || (o = "modal"), n.updateType(o), n.setInnerHtml(t), n.insert(), n
        }
        var n, o, i;
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function");
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    writable: !0,
                    configurable: !0
                }
            }), e && E(t, e)
        }(e, p), n = e, (o = [{
            key: "setInnerHtml",
            value: function (t) {
                var e = this.options.applyReplacements(t, this.type);
                switch (this.type) {
                    case "confirm":
                        var n = ["<button class='".concat(u.klass.button, " ").concat(u.klass.successBtn, "'id='").concat(u.ids.confirmOk, "'>").concat(this.options.labels.confirmOk, "</button>")];
                        !1 !== this[u.ids.confirmCancel] && n.push("<button class='".concat(u.klass.button, " ").concat(u.klass.cancelBtn, "'id='").concat(u.ids.confirmCancel, "'>").concat(this.options.labels.confirmCancel, "</button>")), e = "".concat(this.options.icon(this.type), "<div class='").concat(u.klass.title, "'>").concat(this.options.label(this.type), '</div><div class="').concat(u.klass.content, '">').concat(e, "</div><div class='").concat(u.klass.buttons, " ").concat(u.klass.buttons, "-").concat(n.length, "'>").concat(n.join(), "</div>");
                        break;
                    case "async-block":
                        e = "".concat(e, '<div class="').concat(u.klass.dotAnimation, '"></div>')
                }
                this.newNode.innerHTML = '<div class="'.concat(u.klass.body, " ").concat(this.className, '">').concat(e, "</div>")
            }
        }, {
            key: "keyupListener",
            value: function (t) {
                if ("async-block" === this.type) return t.preventDefault();
                switch (t.code) {
                    case "Escape":
                        t.preventDefault(), this.delete();
                    case "Tab":
                        if (t.preventDefault(), "confirm" !== this.type || !1 === this[u.ids.confirmCancel]) return !0;
                        var e = this.okBtn;
                        t.shiftKey ? document.activeElement.id == u.ids.confirmOk && (e = this.cancelBtn) : document.activeElement.id !== u.ids.confirmCancel && (e = this.cancelBtn), e.focus()
                }
            }
        }, {
            key: "afterInsert",
            value: function () {
                var t = this;
                switch (this.listener = function (e) {
                    return t.keyupListener(e)
                }, window.addEventListener("keydown", this.listener), this.type) {
                    case "async-block":
                        this.start = Date.now();
                        break;
                    case "confirm":
                        this.okBtn.focus(), this.addEvent("click", function (e) {
                            if ("BUTTON" !== e.target.nodeName) return !1;
                            t.delete(), t[e.target.id] && t[e.target.id]()
                        });
                        break;
                    default:
                        document.activeElement.blur(), this.addEvent("click", function (e) {
                            e.target.id === t.newNode.id && t.delete()
                        })
                }
            }
        }, {
            key: "afterDelete",
            value: function () {
                window.removeEventListener("keydown", this.listener)
            }
        }, {
            key: "okBtn",
            get: function () {
                return document.getElementById(u.ids.confirmOk)
            }
        }, {
            key: "cancelBtn",
            get: function () {
                return document.getElementById(u.ids.confirmCancel)
            }
        }]) && O(n.prototype, o), i && O(n, i), e
    }();

    function j(t) {
        return (j = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        })(t)
    }

    function P(t, e) {
        for (var n = 0; n < e.length; n++) {
            var o = e[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(t, o.key, o)
        }
    }
    n.d(e, "default", function () {
        return x
    });
    var x = function () {
        function t() {
            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.options = new a(e)
        }
        var e, n, o;
        return e = t, (n = [{
            key: "tip",
            value: function (t, e) {
                return this._addToast(t, "tip", e).el
            }
        }, {
            key: "info",
            value: function (t, e) {
                return this._addToast(t, "info", e).el
            }
        }, {
            key: "success",
            value: function (t, e) {
                return this._addToast(t, "success", e).el
            }
        }, {
            key: "warning",
            value: function (t, e) {
                return this._addToast(t, "warning", e).el
            }
        }, {
            key: "alert",
            value: function (t, e) {
                return this._addToast(t, "alert", e).el
            }
        }, {
            key: "async",
            value: function (t, e, n, o, i) {
                var r = this._addToast(o, "async", i);
                return this._afterAsync(t, e, n, i, r)
            }
        }, {
            key: "confirm",
            value: function (t, e, n, o) {
                return this._addPopup(t, "confirm", o, e, n)
            }
        }, {
            key: "asyncBlock",
            value: function (t, e, n, o, i) {
                var r = this._addPopup(o, "async-block", i);
                return this._afterAsync(t, e, n, i, r)
            }
        }, {
            key: "modal",
            value: function (t, e, n) {
                return this._addPopup(t, e, n)
            }
        }, {
            key: "_addPopup",
            value: function (t, e, n, o, i) {
                return new S(t, e, this.options.override(n), o, i)
            }
        }, {
            key: "_addToast",
            value: function (t, e, n, o) {
                n = this.options.override(n);
                var i = new g(t, e, n, this.container);
                return o ? o instanceof S ? o.delete().then(function () {
                    return i.insert()
                }) : o.replace(i) : i.insert()
            }
        }, {
            key: "_afterAsync",
            value: function (t, e, n, o, i) {
                return t.then(this._responseHandler(e, "success", o, i), this._responseHandler(n, "alert", o, i))
            }
        }, {
            key: "_responseHandler",
            value: function (t, e, n, o) {
                var i = this;
                return function (r) {
                    switch (j(t)) {
                        case "undefined":
                        case "string":
                            var a = "alert" === e ? t || r : t;
                            i._addToast(a, e, n, o);
                            break;
                        default:
                            o.delete().then(function () {
                                t && t(r)
                            })
                    }
                    return "alert" === e ? Promise.reject(r) : r
                }
            }
        }, {
            key: "_createContainer",
            value: function () {
                return new p(document.body, c.ids.container, "awn-".concat(this.options.position)).insert().el
            }
        }, {
            key: "container",
            get: function () {
                return document.getElementById(c.ids.container) || this._createContainer()
            }
        }]) && P(e.prototype, n), o && P(e, o), t
    }()
}]);

+
    function (a) {
        "use strict";

        function b(a, b) {
            if (!(a instanceof b)) throw new TypeError("Cannot call a class as a function")
        }
        var c = function () {
            function a(a, b) {
                for (var c = 0; c < b.length; c++) {
                    var d = b[c];
                    d.enumerable = d.enumerable || !1, d.configurable = !0, "value" in d && (d.writable = !0), Object.defineProperty(a, d.key, d)
                }
            }
            return function (b, c, d) {
                return c && a(b.prototype, c), d && a(b, d), b
            }
        }();
        (function (a) {
            var d = "ekkoLightbox",
                e = a.fn[d],
                f = {
                    title: "",
                    footer: "",
                    maxWidth: 9999,
                    maxHeight: 9999,
                    showArrows: !0,
                    wrapping: !0,
                    type: null,
                    alwaysShowClose: !1,
                    loadingMessage: '<div class="ekko-lightbox-loader"><div><div></div><div></div></div></div>',
                    leftArrow: "<span>&#10094;</span>",
                    rightArrow: "<span>&#10095;</span>",
                    strings: {
                        close: "Close",
                        fail: "Failed to load image:",
                        type: "Could not detect remote target type. Force the type using data-type"
                    },
                    doc: document,
                    onShow: function () { },
                    onShown: function () { },
                    onHide: function () { },
                    onHidden: function () { },
                    onNavigate: function () { },
                    onContentLoaded: function () { }
                },
                g = function () {
                    function d(c, e) {
                        var g = this;
                        b(this, d), this._config = a.extend({}, f, e), this._$modalArrows = null, this._galleryIndex = 0, this._galleryName = null, this._padding = null, this._border = null, this._titleIsShown = !1, this._footerIsShown = !1, this._wantedWidth = 0, this._wantedHeight = 0, this._touchstartX = 0, this._touchendX = 0, this._modalId = "ekkoLightbox-" + Math.floor(1e3 * Math.random() + 1), this._$element = c instanceof jQuery ? c : a(c), this._isBootstrap3 = 3 == a.fn.modal.Constructor.VERSION[0];
                        var h = '<h4 class="modal-title">' + (this._config.title || "&nbsp;") + "</h4>",
                            i = '<button type="button" class="close" data-dismiss="modal" aria-label="' + this._config.strings.close + '"><span aria-hidden="true">&times;</span></button>',
                            j = '<div class="modal-header' + (this._config.title || this._config.alwaysShowClose ? "" : " hide") + '">' + (this._isBootstrap3 ? i + h : h + i) + "</div>",
                            k = '<div class="modal-footer' + (this._config.footer ? "" : " hide") + '">' + (this._config.footer || "&nbsp;") + "</div>",
                            l = '<div class="modal-body"><div class="ekko-lightbox-container"><div class="ekko-lightbox-item fade in show"></div><div class="ekko-lightbox-item fade"></div></div></div>',
                            m = '<div class="modal-dialog" role="document"><div class="modal-content">' + j + l + k + "</div></div>";
                        a(this._config.doc.body).append('<div id="' + this._modalId + '" class="ekko-lightbox modal fade" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">' + m + "</div>"), this._$modal = a("#" + this._modalId, this._config.doc), this._$modalDialog = this._$modal.find(".modal-dialog").first(), this._$modalContent = this._$modal.find(".modal-content").first(), this._$modalBody = this._$modal.find(".modal-body").first(), this._$modalHeader = this._$modal.find(".modal-header").first(), this._$modalFooter = this._$modal.find(".modal-footer").first(), this._$lightboxContainer = this._$modalBody.find(".ekko-lightbox-container").first(), this._$lightboxBodyOne = this._$lightboxContainer.find("> div:first-child").first(), this._$lightboxBodyTwo = this._$lightboxContainer.find("> div:last-child").first(), this._border = this._calculateBorders(), this._padding = this._calculatePadding(), this._galleryName = this._$element.data("gallery"), this._galleryName && (this._$galleryItems = a(document.body).find('*[data-gallery="' + this._galleryName + '"]'), this._galleryIndex = this._$galleryItems.index(this._$element), a(document).on("keydown.ekkoLightbox", this._navigationalBinder.bind(this)), this._config.showArrows && this._$galleryItems.length > 1 && (this._$lightboxContainer.append('<div class="ekko-lightbox-nav-overlay"><a href="#">' + this._config.leftArrow + '</a><a href="#">' + this._config.rightArrow + "</a></div>"), this._$modalArrows = this._$lightboxContainer.find("div.ekko-lightbox-nav-overlay").first(), this._$lightboxContainer.on("click", "a:first-child", function (a) {
                            return a.preventDefault(), g.navigateLeft()
                        }), this._$lightboxContainer.on("click", "a:last-child", function (a) {
                            return a.preventDefault(), g.navigateRight()
                        }), this.updateNavigation())), this._$modal.on("show.bs.modal", this._config.onShow.bind(this)).on("shown.bs.modal", function () {
                            return g._toggleLoading(!0), g._handle(), g._config.onShown.call(g)
                        }).on("hide.bs.modal", this._config.onHide.bind(this)).on("hidden.bs.modal", function () {
                            return g._galleryName && (a(document).off("keydown.ekkoLightbox"), a(window).off("resize.ekkoLightbox")), g._$modal.remove(), g._config.onHidden.call(g)
                        }).modal(this._config), a(window).on("resize.ekkoLightbox", function () {
                            g._resize(g._wantedWidth, g._wantedHeight)
                        }), this._$lightboxContainer.on("touchstart", function () {
                            g._touchstartX = event.changedTouches[0].screenX
                        }).on("touchend", function () {
                            g._touchendX = event.changedTouches[0].screenX, g._swipeGesure()
                        })
                    }
                    return c(d, null, [{
                        key: "Default",
                        get: function () {
                            return f
                        }
                    }]), c(d, [{
                        key: "element",
                        value: function () {
                            return this._$element
                        }
                    }, {
                        key: "modal",
                        value: function () {
                            return this._$modal
                        }
                    }, {
                        key: "navigateTo",
                        value: function (b) {
                            return b < 0 || b > this._$galleryItems.length - 1 ? this : (this._galleryIndex = b, this.updateNavigation(), this._$element = a(this._$galleryItems.get(this._galleryIndex)), void this._handle())
                        }
                    }, {
                        key: "navigateLeft",
                        value: function () {
                            if (this._$galleryItems && 1 !== this._$galleryItems.length) {
                                if (0 === this._galleryIndex) {
                                    if (!this._config.wrapping) return;
                                    this._galleryIndex = this._$galleryItems.length - 1
                                } else this._galleryIndex--;
                                return this._config.onNavigate.call(this, "left", this._galleryIndex), this.navigateTo(this._galleryIndex)
                            }
                        }
                    }, {
                        key: "navigateRight",
                        value: function () {
                            if (this._$galleryItems && 1 !== this._$galleryItems.length) {
                                if (this._galleryIndex === this._$galleryItems.length - 1) {
                                    if (!this._config.wrapping) return;
                                    this._galleryIndex = 0
                                } else this._galleryIndex++;
                                return this._config.onNavigate.call(this, "right", this._galleryIndex), this.navigateTo(this._galleryIndex)
                            }
                        }
                    }, {
                        key: "updateNavigation",
                        value: function () {
                            if (!this._config.wrapping) {
                                var a = this._$lightboxContainer.find("div.ekko-lightbox-nav-overlay");
                                0 === this._galleryIndex ? a.find("a:first-child").addClass("disabled") : a.find("a:first-child").removeClass("disabled"), this._galleryIndex === this._$galleryItems.length - 1 ? a.find("a:last-child").addClass("disabled") : a.find("a:last-child").removeClass("disabled")
                            }
                        }
                    }, {
                        key: "close",
                        value: function () {
                            return this._$modal.modal("hide")
                        }
                    }, {
                        key: "_navigationalBinder",
                        value: function (a) {
                            return a = a || window.event, 39 === a.keyCode ? this.navigateRight() : 37 === a.keyCode ? this.navigateLeft() : void 0
                        }
                    }, {
                        key: "_detectRemoteType",
                        value: function (a, b) {
                            return b = b || !1, !b && this._isImage(a) && (b = "image"), !b && this._getYoutubeId(a) && (b = "youtube"), !b && this._getVimeoId(a) && (b = "vimeo"), !b && this._getInstagramId(a) && (b = "instagram"), (!b || ["image", "youtube", "vimeo", "instagram", "video", "url"].indexOf(b) < 0) && (b = "url"), b
                        }
                    }, {
                        key: "_isImage",
                        value: function (a) {
                            return a && a.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
                        }
                    }, {
                        key: "_containerToUse",
                        value: function () {
                            var a = this,
                                b = this._$lightboxBodyTwo,
                                c = this._$lightboxBodyOne;
                            return this._$lightboxBodyTwo.hasClass("in") && (b = this._$lightboxBodyOne, c = this._$lightboxBodyTwo), c.removeClass("in show"), setTimeout(function () {
                                a._$lightboxBodyTwo.hasClass("in") || a._$lightboxBodyTwo.empty(), a._$lightboxBodyOne.hasClass("in") || a._$lightboxBodyOne.empty()
                            }, 500), b.addClass("in show"), b
                        }
                    }, {
                        key: "_handle",
                        value: function () {
                            var a = this._containerToUse();
                            this._updateTitleAndFooter();
                            var b = this._$element.attr("data-remote") || this._$element.attr("href"),
                                c = this._detectRemoteType(b, this._$element.attr("data-type") || !1);
                            if (["image", "youtube", "vimeo", "instagram", "video", "url"].indexOf(c) < 0) return this._error(this._config.strings.type);
                            switch (c) {
                                case "image":
                                    this._preloadImage(b, a), this._preloadImageByIndex(this._galleryIndex, 3);
                                    break;
                                case "youtube":
                                    this._showYoutubeVideo(b, a);
                                    break;
                                case "vimeo":
                                    this._showVimeoVideo(this._getVimeoId(b), a);
                                    break;
                                case "instagram":
                                    this._showInstagramVideo(this._getInstagramId(b), a);
                                    break;
                                case "video":
                                    this._showHtml5Video(b, a);
                                    break;
                                default:
                                    this._loadRemoteContent(b, a)
                            }
                            return this
                        }
                    }, {
                        key: "_getYoutubeId",
                        value: function (a) {
                            if (!a) return !1;
                            var b = a.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);
                            return !(!b || 11 !== b[2].length) && b[2]
                        }
                    }, {
                        key: "_getVimeoId",
                        value: function (a) {
                            return !!(a && a.indexOf("vimeo") > 0) && a
                        }
                    }, {
                        key: "_getInstagramId",
                        value: function (a) {
                            return !!(a && a.indexOf("instagram") > 0) && a
                        }
                    }, {
                        key: "_toggleLoading",
                        value: function (b) {
                            return b = b || !1, b ? (this._$modalDialog.css("display", "none"), this._$modal.removeClass("in show"), a(".modal-backdrop").append(this._config.loadingMessage)) : (this._$modalDialog.css("display", "block"), this._$modal.addClass("in show"), a(".modal-backdrop").find(".ekko-lightbox-loader").remove()), this
                        }
                    }, {
                        key: "_calculateBorders",
                        value: function () {
                            return {
                                top: this._totalCssByAttribute("border-top-width"),
                                right: this._totalCssByAttribute("border-right-width"),
                                bottom: this._totalCssByAttribute("border-bottom-width"),
                                left: this._totalCssByAttribute("border-left-width")
                            }
                        }
                    }, {
                        key: "_calculatePadding",
                        value: function () {
                            return {
                                top: this._totalCssByAttribute("padding-top"),
                                right: this._totalCssByAttribute("padding-right"),
                                bottom: this._totalCssByAttribute("padding-bottom"),
                                left: this._totalCssByAttribute("padding-left")
                            }
                        }
                    }, {
                        key: "_totalCssByAttribute",
                        value: function (a) {
                            return parseInt(this._$modalDialog.css(a), 10) + parseInt(this._$modalContent.css(a), 10) + parseInt(this._$modalBody.css(a), 10)
                        }
                    }, {
                        key: "_updateTitleAndFooter",
                        value: function () {
                            var a = this._$element.data("title") || "",
                                b = this._$element.data("footer") || "";
                            return this._titleIsShown = !1, a || this._config.alwaysShowClose ? (this._titleIsShown = !0, this._$modalHeader.css("display", "").find(".modal-title").html(a || "&nbsp;")) : this._$modalHeader.css("display", "none"), this._footerIsShown = !1, b ? (this._footerIsShown = !0, this._$modalFooter.css("display", "").html(b)) : this._$modalFooter.css("display", "none"), this
                        }
                    }, {
                        key: "_showYoutubeVideo",
                        value: function (a, b) {
                            var c = this._getYoutubeId(a),
                                d = a.indexOf("&") > 0 ? a.substr(a.indexOf("&")) : "",
                                e = this._$element.data("width") || 560,
                                f = this._$element.data("height") || e / (560 / 315);
                            return this._showVideoIframe("//www.youtube.com/embed/" + c + "?badge=0&autoplay=1&html5=1" + d, e, f, b)
                        }
                    }, {
                        key: "_showVimeoVideo",
                        value: function (a, b) {
                            var c = this._$element.data("width") || 500,
                                d = this._$element.data("height") || c / (560 / 315);
                            return this._showVideoIframe(a + "?autoplay=1", c, d, b)
                        }
                    }, {
                        key: "_showInstagramVideo",
                        value: function (a, b) {
                            var c = this._$element.data("width") || 612,
                                d = c + 80;
                            return a = "/" !== a.substr(-1) ? a + "/" : a, b.html('<iframe width="' + c + '" height="' + d + '" src="' + a + 'embed/" frameborder="0" allowfullscreen></iframe>'), this._resize(c, d), this._config.onContentLoaded.call(this), this._$modalArrows && this._$modalArrows.css("display", "none"), this._toggleLoading(!1), this
                        }
                    }, {
                        key: "_showVideoIframe",
                        value: function (a, b, c, d) {
                            return c = c || b, d.html('<div class="embed-responsive embed-responsive-16by9"><iframe width="' + b + '" height="' + c + '" src="' + a + '" frameborder="0" allowfullscreen class="embed-responsive-item"></iframe></div>'), this._resize(b, c), this._config.onContentLoaded.call(this), this._$modalArrows && this._$modalArrows.css("display", "none"), this._toggleLoading(!1), this
                        }
                    }, {
                        key: "_showHtml5Video",
                        value: function (a, b) {
                            var c = this._$element.data("width") || 560,
                                d = this._$element.data("height") || c / (560 / 315);
                            return b.html('<div class="embed-responsive embed-responsive-16by9"><video width="' + c + '" height="' + d + '" src="' + a + '" preload="auto" autoplay controls class="embed-responsive-item"></video></div>'), this._resize(c, d), this._config.onContentLoaded.call(this), this._$modalArrows && this._$modalArrows.css("display", "none"), this._toggleLoading(!1), this
                        }
                    }, {
                        key: "_loadRemoteContent",
                        value: function (b, c) {
                            var d = this,
                                e = this._$element.data("width") || 560,
                                f = this._$element.data("height") || 560,
                                g = this._$element.data("disableExternalCheck") || !1;
                            return this._toggleLoading(!1), g || this._isExternal(b) ? (c.html('<iframe src="' + b + '" frameborder="0" allowfullscreen></iframe>'), this._config.onContentLoaded.call(this)) : c.load(b, a.proxy(function () {
                                return d._$element.trigger("loaded.bs.modal")
                            })), this._$modalArrows && this._$modalArrows.css("display", "none"), this._resize(e, f), this
                        }
                    }, {
                        key: "_isExternal",
                        value: function (a) {
                            var b = a.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
                            return "string" == typeof b[1] && b[1].length > 0 && b[1].toLowerCase() !== location.protocol || "string" == typeof b[2] && b[2].length > 0 && b[2].replace(new RegExp(":(" + {
                                "http:": 80,
                                "https:": 443
                            }[location.protocol] + ")?$"), "") !== location.host
                        }
                    }, {
                        key: "_error",
                        value: function (a) {
                            return console.error(a), this._containerToUse().html(a), this._resize(300, 300), this
                        }
                    }, {
                        key: "_preloadImageByIndex",
                        value: function (b, c) {
                            if (this._$galleryItems) {
                                var d = a(this._$galleryItems.get(b), !1);
                                if ("undefined" != typeof d) {
                                    var e = d.attr("data-remote") || d.attr("href");
                                    return ("image" === d.attr("data-type") || this._isImage(e)) && this._preloadImage(e, !1), c > 0 ? this._preloadImageByIndex(b + 1, c - 1) : void 0
                                }
                            }
                        }
                    }, {
                        key: "_preloadImage",
                        value: function (b, c) {
                            var d = this;
                            c = c || !1;
                            var e = new Image;
                            return c && ! function () {
                                var f = setTimeout(function () {
                                    c.append(d._config.loadingMessage)
                                }, 200);
                                e.onload = function () {
                                    f && clearTimeout(f), f = null;
                                    var b = a("<img />");
                                    return b.attr("src", e.src), b.addClass("img-fluid"), b.css("width", "100%"), c.html(b), d._$modalArrows && d._$modalArrows.css("display", ""), d._resize(e.width, e.height), d._toggleLoading(!1), d._config.onContentLoaded.call(d)
                                }, e.onerror = function () {
                                    return d._toggleLoading(!1), d._error(d._config.strings.fail + ("  " + b))
                                }
                            }(), e.src = b, e
                        }
                    }, {
                        key: "_swipeGesure",
                        value: function () {
                            return this._touchendX < this._touchstartX ? this.navigateRight() : this._touchendX > this._touchstartX ? this.navigateLeft() : void 0
                        }
                    }, {
                        key: "_resize",
                        value: function (b, c) {
                            c = c || b, this._wantedWidth = b, this._wantedHeight = c;
                            var d = b / c,
                                e = this._padding.left + this._padding.right + this._border.left + this._border.right,
                                f = this._config.doc.body.clientWidth > 575 ? 20 : 0,
                                g = this._config.doc.body.clientWidth > 575 ? 0 : 20,
                                h = Math.min(b + e, this._config.doc.body.clientWidth - f, this._config.maxWidth);
                            b + e > h ? (c = (h - e - g) / d, b = h) : b += e;
                            var i = 0,
                                j = 0;
                            this._footerIsShown && (j = this._$modalFooter.outerHeight(!0) || 55), this._titleIsShown && (i = this._$modalHeader.outerHeight(!0) || 67);
                            var k = this._padding.top + this._padding.bottom + this._border.bottom + this._border.top,
                                l = parseFloat(this._$modalDialog.css("margin-top")) + parseFloat(this._$modalDialog.css("margin-bottom")),
                                m = Math.min(c, a(window).height() - k - l - i - j, this._config.maxHeight - k - i - j);
                            c > m && (b = Math.ceil(m * d) + e), this._$lightboxContainer.css("height", m), this._$modalDialog.css("flex", 1).css("maxWidth", b);
                            var n = this._$modal.data("bs.modal");
                            if (n) try {
                                n._handleUpdate()
                            } catch (o) {
                                n.handleUpdate()
                            }
                            return this
                        }
                    }], [{
                        key: "_jQueryInterface",
                        value: function (b) {
                            var c = this;
                            return b = b || {}, this.each(function () {
                                var e = a(c),
                                    f = a.extend({}, d.Default, e.data(), "object" == typeof b && b);
                                new d(c, f)
                            })
                        }
                    }]), d
                }();
            return a.fn[d] = g._jQueryInterface, a.fn[d].Constructor = g, a.fn[d].noConflict = function () {
                return a.fn[d] = e, g._jQueryInterface
            }, g
        })(jQuery)
    }(jQuery);
//# sourceMappingURL=ekko-lightbox.min.js.map


$(document).ready(function () {

    window.Util = {};
    
    var theOptions = {
        position: 'bottom-right',
        maxNotifications: 5,
        icons: {
            enabled: false
        },
        durations: {
            global: 2000
        }
    };

    // Notification Object, Is Global
    window.theNotifier = new AWN(theOptions);


    // Setup CSRF Token for Laravel Forms
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            showArrows: true,
            alwaysShowClose: true
        });
    });

    window.Util.trim = function (el) {
        el.value = el.value.
            replace(/(^\s*)|(\s*$)/gi, ""). // removes leading and trailing spaces
            replace(/[ ]{2,}/gi, " "). // replaces multiple spaces with one space 
            replace(/\n +/, "\n"); // Removes spaces after newlines
        return;
    }

    // Show Attached Pictures in the browser
    $('#itemPictures').change(function () {
        var ext = $(this).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'svg']) === -1) {
            theNotifier.alert('Invalid File Extension!!!');
            $(this).val('');
        }
        if (this.files) {
            var filesAmount = this.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo('#previewImages');
                }
                reader.readAsDataURL(this.files[i]);
            }
            $('#picSize').fadeIn();
        }
    });


});
