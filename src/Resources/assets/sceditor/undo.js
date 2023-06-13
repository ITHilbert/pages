/* SCEditor v3.2.0 | (C) 2017, Sam Clarke | sceditor.com/license */ ! function() { "use strict";
    sceditor.plugins.undo = function() { var n, i, a, o, r = this,
            s = "",
            c = 0,
            u = !1,
            d = !1,
            l = !1,
            e = 50,
            t = [],
            g = 0;

        function f(e) { if (d = !0, i.sourceMode(e.sourceMode), e.sourceMode) i.val(e.value, !1), i.sourceEditorCaret(e.caret);
            else if (i.getBody().innerHTML = e.value, e.caret) { var t = i.getRangeHelper().selectedRange(),
                    n = t,
                    e = e.caret; try { var o = e.startPositions,
                        r = e.endPositions;
                    n.setStart(S(a, o), o[0]), n.setEnd(S(a, r), r[0]) } catch (e) { console && console.warn && console.warn("[SCEditor] Undo plugin lost caret", e) }
                i.getRangeHelper().selectRange(t) }
            i.focus(), d = !1 }

        function p(e, t) { var n = e[t];
            e[t] = function() { var e = u;!e && !d && o && i.getRangeHelper().hasSelection() && h(), u = !0, n.apply(this, arguments), e || (u = !1, d || (v(), s = "")) } }

        function v() { g && (t.length -= g, g = 0), 0 < e && t.length > e && t.shift(), o = {}, h(), t.push(o) }

        function h() { var e = i.sourceMode();
            o.caret = e ? i.sourceEditorCaret() : function(e) { if (e) return a.normalize(), { startPositions: y(e.startContainer, e.startOffset), endPositions: y(e.endContainer, e.endOffset) } }(i.getRangeHelper().selectedRange()), o.sourceMode = e, o.value = e ? i.getSourceEditorValue(!1) : i.getBody().innerHTML }

        function E() { n === document.activeElement && r.signalSelectionchangedEvent() }

        function y(e, t) { for (var n = [t], o = e; o && "BODY" !== o.tagName;) n.push(function(e) { var t = 0; for (; e = e.previousSibling;) t++; return t }(o)), o = o.parentNode; return n }

        function S(e, t) { for (var n = t.length - 1; e && 0 < n; n--) e = e.childNodes[t[n]]; return e }
        r.init = function() { e = (i = this).undoLimit || e, i.addShortcut("ctrl+z", r.undo), i.addShortcut("ctrl+shift+z", r.redo), i.addShortcut("ctrl+y", r.redo) }, r.signalReady = function() {
            function e(e) { "historyUndo" === e.inputType ? (r.undo(), e.preventDefault()) : "historyRedo" === e.inputType && (r.redo(), e.preventDefault()) }

            function t() { s = "", v() }
            n = i.getContentAreaContainer().nextSibling, a = i.getBody(), v(), p(i, "setWysiwygEditorValue"), p(i, "setSourceEditorValue"), p(i, "sourceEditorInsertText"), p(i.getRangeHelper(), "insertNode"), p(i, "toggleSourceMode"), a.addEventListener("beforeinput", e), n.addEventListener("beforeinput", e), a.addEventListener("compositionend", t), n.addEventListener("compositionend", t), document.addEventListener("selectionchange", E) }, r.destroy = function() { document.removeEventListener("selectionchange", E) }, r.undo = function() { return o = null, g < t.length - 1 && (g++, f(t[t.length - 1 - g])), !1 }, r.redo = function() { return 0 < g && (g--, f(t[t.length - 1 - g])), !1 }, r.signalSelectionchangedEvent = function() { d || l ? l = !1 : (o && h(), s = "") }, r.signalInputEvent = function(e) { var t = e.inputType; if (l = !0, t && !e.isComposing) switch (e.inputType) {
                case "deleteContentBackward":
                    o && s === t && c < 20 ? h() : (v(), c = 0), s = t; break;
                case "insertText":
                    c += e.data ? e.data.length : 1, o && s === t && c < 20 && !/\s$/.test(e.data) ? h() : (v(), c = 0), s = t; break;
                default:
                    s = "sce-misc", c = 0, v() } } } }();