/* -----------------------
 * Create the map
 * https://leafletjs.com/
 * --------------------- */

CRUMINA.maps = {
  maps: {
    mapUSA: {
      config: {
        id: "map",
        map: {
          center: new L.LatLng(22.0702594, 82.1430075),
          zoom: 3,
          maxZoom: 18,
          layers: new L.tileLayer(
            "https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png",
            {
              maxZoom: 18,
              attribution: "",
            }
          ),
        },
        icon: {
          iconSize: [100, 118],
          iconAnchor: [22, 94],
          className: "icon-map",
        },
      },
      markers: [
        {
          coords: [22.0702594, 82.1430075],
          icon: "marker-google.png",
        },
        {
          coords: [21.0702594, 80.1430075],
          icon: "marker-google.png",
        },
        {
          coords: [20.0702594, 78.1430075],
          icon: "marker-google.png",
        },
        {
          coords: [19.0702594, 76.1430075],
          icon: "marker-google.png",
        },
        {
          coords: [18.0702594, 74.1430075],
          icon: "marker-google.png",
        },
      ],
    },
  },
  init: function () {
    var _this = this;

    for (var key in this.maps) {
      var data = this.maps[key];

      if (!data.config || !data.markers) {
        continue;
      }

      if (!document.getElementById(data.config.id)) {
        continue;
      }

      var map = new L.map(data.config.id, data.config.map);
      var cluster = L.markerClusterGroup({
        iconCreateFunction: function (cluster) {
          var childCount = cluster.getChildCount();
          var config = data.config.cluster;
          return new L.DivIcon({
            html: "<div><span>" + childCount + "</span></div>",
            className: "marker-cluster marker-cluster-" + key,
            iconSize: new L.Point(config.iconSize[0], config.iconSize[1]),
          });
        },
      });
      data.markers.forEach(function (item) {
        data.config.icon["iconUrl"] = "./img/" + item.icon;
        var icon = L.icon(data.config.icon);

        var marker = L.marker(item.coords, { icon: icon });
        cluster.addLayer(marker);
      });

      map.addLayer(cluster);
      this.disableScroll(jQuery("#" + data.config.id), map);
    }
  },
  disableScroll: function ($map, map) {
    map.scrollWheelZoom.disable();

    $map.bind("mousewheel DOMMouseScroll", function (event) {
      event.stopPropagation();
      if (event.ctrlKey == true) {
        event.preventDefault();
        map.scrollWheelZoom.enable();
        setTimeout(function () {
          map.scrollWheelZoom.disable();
        }, 1000);
      } else {
        map.scrollWheelZoom.disable();
      }
    });
  },
};

$(document).ready(function () {
  CRUMINA.maps.init();
});
