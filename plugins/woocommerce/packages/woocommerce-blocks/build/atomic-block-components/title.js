(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[18],{154:function(e,t,c){"use strict";var n=c(9),o=c.n(n),r=c(16),a=c.n(r),i=c(0),l=c(25),s=c(6),u=c.n(s),b=(c(205),["className","disabled","name","permalink"]);t.a=function(e){var t=e.className,c=void 0===t?"":t,n=e.disabled,r=void 0!==n&&n,s=e.name,p=e.permalink,d=void 0===p?"":p,m=a()(e,b),O=u()("wc-block-components-product-name",c);return r?Object(i.createElement)("span",o()({className:O},m,{dangerouslySetInnerHTML:{__html:Object(l.decodeEntities)(s)}})):Object(i.createElement)("a",o()({className:O,href:d},m,{dangerouslySetInnerHTML:{__html:Object(l.decodeEntities)(s)}}))}},205:function(e,t){},373:function(e,t,c){"use strict";var n=c(5),o=c.n(n),r=c(159);function a(e,t){var c=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),c.push.apply(c,n)}return c}function i(e){for(var t=1;t<arguments.length;t++){var c=null!=arguments[t]?arguments[t]:{};t%2?a(Object(c),!0).forEach((function(t){o()(e,t,c[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(c)):a(Object(c)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(c,t))}))}return e}var l={headingLevel:{type:"number",default:2},showProductLink:{type:"boolean",default:!0},productId:{type:"number",default:0}};Object(r.b)()&&(l=i(i({},l),{},{align:{type:"string"},color:{type:"string"},customColor:{type:"string"},fontSize:{type:"string"},customFontSize:{type:"number"}})),t.a=l},378:function(e,t,c){"use strict";var n=c(5),o=c.n(n),r=c(0),a=(c(2),c(6)),i=c.n(a),l=c(45),s=c(12),u=c(159),b=function(e){var t=e.color,c=e.fontSize;return Object(u.b)()?{color:t,fontSize:c}:{}},p=c(86),d=c(154),m=c(68);c(556),t.a=Object(p.withProductDataContext)((function(e){var t,c,n,a=e.className,p=e.headingLevel,O=void 0===p?2:p,f=e.showProductLink,j=void 0===f||f,y=e.align,w=e.color,g=e.customColor,v=e.fontSize,k=e.customFontSize,h=Object(l.useInnerBlockLayoutContext)().parentClassName,S=Object(l.useProductDataContext)().product,P=Object(m.a)().dispatchStoreEvent,z="h".concat(O),C=Object(s.getColorClassName)("color",w),E=Object(s.getFontSizeClass)(v),N=i()((t={"has-text-color":w||g,"has-font-size":v||k},o()(t,C,C),o()(t,E,E),t));return S.id?Object(r.createElement)(z,{className:i()(a,"wc-block-components-product-title",(c={},o()(c,"".concat(h,"__product-title"),h),o()(c,"wc-block-components-product-title--align-".concat(y),y&&Object(u.b)()),c))},Object(r.createElement)(d.a,{className:i()(o()({},N,Object(u.b)())),disabled:!j,name:S.name,permalink:S.permalink,rel:j?"nofollow":null,style:b({color:g,fontSize:k}),onClick:function(){P("product-view-link",{product:S})}})):Object(r.createElement)(z,{className:i()(a,"wc-block-components-product-title",(n={},o()(n,"".concat(h,"__product-title"),h),o()(n,"wc-block-components-product-title--align-".concat(y),y&&Object(u.b)()),o()(n,N,Object(u.b)()),n)),style:b({color:g,fontSize:k})})}))},556:function(e,t){},902:function(e,t,c){"use strict";c.r(t);var n=c(900),o=c(378),r=c(373);t.default=Object(n.a)(r.a)(o.a)}}]);