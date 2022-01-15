!(function (e) {
    "function" == typeof define && define.amd
        ? define("picker", ["jquery"], e)
        : "object" == typeof exports
        ? (module.exports = e(require("jquery")))
        : "object" == typeof window
        ? (window.Picker = e(jQuery))
        : (this.Picker = e(jQuery));
})(function (e) {
    var t = e(window),
        n = e(document),
        o = e(document.documentElement),
        r = null != document.documentElement.style.transition;
    function i(t, o, c, l) {
        if (!t) return i;
        var f = !1,
            p = {
                id: t.id || "P" + Math.abs(~~(Math.random() * new Date())),
                handlingOpen: !1,
            },
            h = c ? e.extend(!0, {}, c.defaults, l) : l || {},
            m = e.extend({}, i.klasses(), h.klass),
            g = e(t),
            v = function () {
                return this.start();
            },
            y = (v.prototype = {
                constructor: v,
                $node: g,
                start: function () {
                    return p && p.start
                        ? y
                        : ((p.methods = {}),
                          (p.start = !0),
                          (p.open = !1),
                          (p.type = t.type),
                          (t.autofocus = t == s()),
                          (t.readOnly = !h.editable),
                          (h.id = t.id = t.id || p.id),
                          "text" != t.type && (t.type = "text"),
                          (y.component = new c(y, h)),
                          (y.$root = e(
                              '<div class="' +
                                  m.picker +
                                  '" id="' +
                                  t.id +
                                  '_root" />'
                          )),
                          u(y.$root[0], "hidden", !0),
                          (y.$holder = e(_()).appendTo(y.$root)),
                          $(),
                          h.formatSubmit &&
                              (function () {
                                  var n;
                                  !0 === h.hiddenName
                                      ? ((n = t.name), (t.name = ""))
                                      : (n =
                                            (n = [
                                                "string" ==
                                                typeof h.hiddenPrefix
                                                    ? h.hiddenPrefix
                                                    : "",
                                                "string" ==
                                                typeof h.hiddenSuffix
                                                    ? h.hiddenSuffix
                                                    : "_submit",
                                            ])[0] +
                                            t.name +
                                            n[1]);
                                  (y._hidden = e(
                                      '<input type=hidden name="' +
                                          n +
                                          '"' +
                                          (g.data("value") || t.value
                                              ? ' value="' +
                                                y.get(
                                                    "select",
                                                    h.formatSubmit
                                                ) +
                                                '"'
                                              : "") +
                                          ">"
                                  )[0]),
                                      g.on("change." + p.id, function () {
                                          y._hidden.value = t.value
                                              ? y.get("select", h.formatSubmit)
                                              : "";
                                      });
                              })(),
                          (function () {
                              g
                                  .data(o, y)
                                  .addClass(m.input)
                                  .val(
                                      g.data("value")
                                          ? y.get("select", h.format)
                                          : t.value
                                  )
                                  .on(
                                      "focus." + p.id + " click." + p.id,
                                      function (e) {
                                          e.preventDefault(), y.open();
                                      }
                                  )
                                  .on("mousedown", function () {
                                      p.handlingOpen = !0;
                                      var t = function () {
                                          setTimeout(function () {
                                              e(document).off("mouseup", t),
                                                  (p.handlingOpen = !1);
                                          }, 0);
                                      };
                                      e(document).on("mouseup", t);
                                  }),
                                  h.editable || g.on("keydown." + p.id, w);
                              u(t, {
                                  haspopup: !0,
                                  readonly: !1,
                                  owns: t.id + "_root",
                              });
                          })(),
                          h.containerHidden
                              ? e(h.containerHidden).append(y._hidden)
                              : g.after(y._hidden),
                          h.container
                              ? e(h.container).append(y.$root)
                              : g.after(y.$root),
                          y
                              .on({
                                  start: y.component.onStart,
                                  render: y.component.onRender,
                                  stop: y.component.onStop,
                                  open: y.component.onOpen,
                                  close: y.component.onClose,
                                  set: y.component.onSet,
                              })
                              .on({
                                  start: h.onStart,
                                  render: h.onRender,
                                  stop: h.onStop,
                                  open: h.onOpen,
                                  close: h.onClose,
                                  set: h.onSet,
                              }),
                          (f = (function (e) {
                              var t,
                                  n = "position";
                              e.currentStyle
                                  ? (t = e.currentStyle[n])
                                  : window.getComputedStyle &&
                                    (t = getComputedStyle(e)[n]);
                              return "fixed" == t;
                          })(y.$holder[0])),
                          t.autofocus && y.open(),
                          y.trigger("start").trigger("render"));
                },
                render: function (t) {
                    return (
                        t
                            ? ((y.$holder = e(_())),
                              $(),
                              y.$root.html(y.$holder))
                            : y.$root
                                  .find("." + m.box)
                                  .html(y.component.nodes(p.open)),
                        y.trigger("render")
                    );
                },
                stop: function () {
                    return p.start
                        ? (y.close(),
                          y._hidden &&
                              y._hidden.parentNode.removeChild(y._hidden),
                          y.$root.remove(),
                          g.removeClass(m.input).removeData(o),
                          setTimeout(function () {
                              g.off("." + p.id);
                          }, 0),
                          (t.type = p.type),
                          (t.readOnly = !1),
                          y.trigger("stop"),
                          (p.methods = {}),
                          (p.start = !1),
                          y)
                        : y;
                },
                open: function (o) {
                    return p.open
                        ? y
                        : (g.addClass(m.active),
                          setTimeout(function () {
                              y.$root.addClass(m.opened),
                                  u(y.$root[0], "hidden", !1);
                          }, 0),
                          !1 !== o &&
                              ((p.open = !0),
                              f &&
                                  e("body")
                                      .css("overflow", "hidden")
                                      .css("padding-right", "+=" + a()),
                              f && r
                                  ? y.$holder
                                        .find("." + m.frame)
                                        .one("transitionend", function () {
                                            y.$holder.eq(0).focus();
                                        })
                                  : setTimeout(function () {
                                        y.$holder.eq(0).focus();
                                    }, 0),
                              n
                                  .on(
                                      "click." + p.id + " focusin." + p.id,
                                      function (e) {
                                          if (!p.handlingOpen) {
                                              var n = d(e, t);
                                              e.isSimulated ||
                                                  n == t ||
                                                  n == document ||
                                                  3 == e.which ||
                                                  y.close(n === y.$holder[0]);
                                          }
                                      }
                                  )
                                  .on("keydown." + p.id, function (n) {
                                      var o = n.keyCode,
                                          r = y.component.key[o],
                                          a = d(n, t);
                                      27 == o
                                          ? y.close(!0)
                                          : a != y.$holder[0] || (!r && 13 != o)
                                          ? e.contains(y.$root[0], a) &&
                                            13 == o &&
                                            (n.preventDefault(), a.click())
                                          : (n.preventDefault(),
                                            r
                                                ? i._.trigger(
                                                      y.component.key.go,
                                                      y,
                                                      [i._.trigger(r)]
                                                  )
                                                : y.$root
                                                      .find("." + m.highlighted)
                                                      .hasClass(m.disabled) ||
                                                  (y.set(
                                                      "select",
                                                      y.component.item.highlight
                                                  ),
                                                  h.closeOnSelect &&
                                                      y.close(!0)));
                                  })),
                          y.trigger("open"));
                },
                close: function (o) {
                    return (
                        o &&
                            (h.editable
                                ? t.focus()
                                : (y.$holder.off("focus.toOpen").focus(),
                                  setTimeout(function () {
                                      y.$holder.on("focus.toOpen", b);
                                  }, 0))),
                        g.removeClass(m.active),
                        setTimeout(function () {
                            y.$root.removeClass(m.opened + " " + m.focused),
                                u(y.$root[0], "hidden", !0);
                        }, 0),
                        p.open
                            ? ((p.open = !1),
                              f &&
                                  e("body")
                                      .css("overflow", "")
                                      .css("padding-right", "-=" + a()),
                              n.off("." + p.id),
                              y.trigger("close"))
                            : y
                    );
                },
                clear: function (e) {
                    return y.set("clear", null, e);
                },
                set: function (t, n, o) {
                    var r,
                        i,
                        a = e.isPlainObject(t),
                        d = a ? t : {};
                    if (((o = a && e.isPlainObject(n) ? n : o || {}), t)) {
                        for (r in (a || (d[t] = n), d))
                            (i = d[r]),
                                r in y.component.item &&
                                    (void 0 === i && (i = null),
                                    y.component.set(r, i, o)),
                                ("select" != r && "clear" != r) ||
                                    !h.updateInput ||
                                    g
                                        .val(
                                            "clear" == r
                                                ? ""
                                                : y.get(r, h.format)
                                        )
                                        .trigger("change");
                        y.render();
                    }
                    return o.muted ? y : y.trigger("set", d);
                },
                get: function (e, n) {
                    if (null != p[(e = e || "value")]) return p[e];
                    if ("valueSubmit" == e) {
                        if (y._hidden) return y._hidden.value;
                        e = "value";
                    }
                    if ("value" == e) return t.value;
                    if (e in y.component.item) {
                        if ("string" == typeof n) {
                            var o = y.component.get(e);
                            return o
                                ? i._.trigger(
                                      y.component.formats.toString,
                                      y.component,
                                      [n, o]
                                  )
                                : "";
                        }
                        return y.component.get(e);
                    }
                },
                on: function (t, n, o) {
                    var r,
                        i,
                        a = e.isPlainObject(t),
                        d = a ? t : {};
                    if (t)
                        for (r in (a || (d[t] = n), d))
                            (i = d[r]),
                                o && (r = "_" + r),
                                (p.methods[r] = p.methods[r] || []),
                                p.methods[r].push(i);
                    return y;
                },
                off: function () {
                    var e,
                        t,
                        n = arguments;
                    for (e = 0, namesCount = n.length; e < namesCount; e += 1)
                        (t = n[e]) in p.methods && delete p.methods[t];
                    return y;
                },
                trigger: function (e, t) {
                    var n = function (e) {
                        var n = p.methods[e];
                        n &&
                            n.map(function (e) {
                                i._.trigger(e, y, [t]);
                            });
                    };
                    return n("_" + e), n(e), y;
                },
            });
        function _() {
            return i._.node(
                "div",
                i._.node(
                    "div",
                    i._.node(
                        "div",
                        i._.node("div", y.component.nodes(p.open), m.box),
                        m.wrap
                    ),
                    m.frame
                ),
                m.holder,
                'tabindex="-1"'
            );
        }
        function $() {
            y.$holder
                .on({
                    keydown: w,
                    "focus.toOpen": b,
                    blur: function () {
                        g.removeClass(m.target);
                    },
                    focusin: function (e) {
                        y.$root.removeClass(m.focused), e.stopPropagation();
                    },
                    "mousedown click": function (n) {
                        var o = d(n, t);
                        o != y.$holder[0] &&
                            (n.stopPropagation(),
                            "mousedown" != n.type ||
                                e(o).is(
                                    "input, select, textarea, button, option"
                                ) ||
                                (n.preventDefault(), y.$holder.eq(0).focus()));
                    },
                })
                .on(
                    "click",
                    "[data-pick], [data-nav], [data-clear], [data-close]",
                    function () {
                        var t = e(this),
                            n = t.data(),
                            o =
                                t.hasClass(m.navDisabled) ||
                                t.hasClass(m.disabled),
                            r = s();
                        (r = r && (r.type || r.href ? r : null)),
                            (o || (r && !e.contains(y.$root[0], r))) &&
                                y.$holder.eq(0).focus(),
                            !o && n.nav
                                ? y.set(
                                      "highlight",
                                      y.component.item.highlight,
                                      { nav: n.nav }
                                  )
                                : !o && "pick" in n
                                ? (y.set("select", n.pick),
                                  h.closeOnSelect && y.close(!0))
                                : n.clear
                                ? (y.clear(), h.closeOnClear && y.close(!0))
                                : n.close && y.close(!0);
                    }
                );
        }
        function b(e) {
            e.stopPropagation(),
                g.addClass(m.target),
                y.$root.addClass(m.focused),
                y.open();
        }
        function w(e) {
            var t = e.keyCode,
                n = /^(8|46)$/.test(t);
            if (27 == t) return y.close(!0), !1;
            (32 == t || n || (!p.open && y.component.key[t])) &&
                (e.preventDefault(),
                e.stopPropagation(),
                n ? y.clear().close() : y.open());
        }
        return new v();
    }
    function a() {
        if (o.height() <= t.height()) return 0;
        var n = e('<div style="visibility:hidden;width:100px" />').appendTo(
                "body"
            ),
            r = n[0].offsetWidth;
        n.css("overflow", "scroll");
        var i = e('<div style="width:100%" />').appendTo(n)[0].offsetWidth;
        return n.remove(), r - i;
    }
    function d(e, t) {
        var n = [];
        return (
            e.path && (n = e.path),
            e.originalEvent &&
                e.originalEvent.path &&
                (n = e.originalEvent.path),
            n && n.length > 0 ? (t && n.indexOf(t) >= 0 ? t : n[0]) : e.target
        );
    }
    function u(t, n, o) {
        if (e.isPlainObject(n)) for (var r in n) c(t, r, n[r]);
        else c(t, n, o);
    }
    function c(e, t, n) {
        e.setAttribute(("role" == t ? "" : "aria-") + t, n);
    }
    function s() {
        try {
            return document.activeElement;
        } catch (e) {}
    }
    return (
        (i.klasses = function (e) {
            return {
                picker: (e = e || "picker"),
                opened: e + "--opened",
                focused: e + "--focused",
                input: e + "__input",
                active: e + "__input--active",
                target: e + "__input--target",
                holder: e + "__holder",
                frame: e + "__frame",
                wrap: e + "__wrap",
                box: e + "__box",
            };
        }),
        (i._ = {
            group: function (e) {
                for (
                    var t, n = "", o = i._.trigger(e.min, e);
                    o <= i._.trigger(e.max, e, [o]);
                    o += e.i
                )
                    (t = i._.trigger(e.item, e, [o])),
                        (n += i._.node(e.node, t[0], t[1], t[2]));
                return n;
            },
            node: function (t, n, o, r) {
                return n
                    ? "<" +
                          t +
                          (o = o ? ' class="' + o + '"' : "") +
                          (r = r ? " " + r : "") +
                          ">" +
                          (n = e.isArray(n) ? n.join("") : n) +
                          "</" +
                          t +
                          ">"
                    : "";
            },
            lead: function (e) {
                return (e < 10 ? "0" : "") + e;
            },
            trigger: function (e, t, n) {
                return "function" == typeof e ? e.apply(t, n || []) : e;
            },
            digits: function (e) {
                return /\d/.test(e[1]) ? 2 : 1;
            },
            isDate: function (e) {
                return (
                    {}.toString.call(e).indexOf("Date") > -1 &&
                    this.isInteger(e.getDate())
                );
            },
            isInteger: function (e) {
                return {}.toString.call(e).indexOf("Number") > -1 && e % 1 == 0;
            },
            ariaAttr: function (t, n) {
                e.isPlainObject(t) || (t = { attribute: n });
                for (var o in ((n = ""), t)) {
                    var r = ("role" == o ? "" : "aria-") + o,
                        i = t[o];
                    n += null == i ? "" : r + '="' + t[o] + '"';
                }
                return n;
            },
        }),
        (i.extend = function (t, n) {
            (e.fn[t] = function (o, r) {
                var a = this.data(t);
                return "picker" == o
                    ? a
                    : a && "string" == typeof o
                    ? i._.trigger(a[o], a, [r])
                    : this.each(function () {
                          e(this).data(t) || new i(this, t, n, o);
                      });
            }),
                (e.fn[t].defaults = n.defaults);
        }),
        i
    );
});
