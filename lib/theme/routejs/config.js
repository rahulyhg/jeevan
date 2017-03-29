define({
    server: {
        baseUrl: FRONTEND_URL + APIDATA_URL
    },
    startPosition: {
        lat: 48.740,
        lng: 19.140,
        zoom: 13,
        mapTypeId: "roadmap"
    },
    newProject: {
        name: "Jeevanacharya Toor Plan",
        description: "This is sample description",
        layers: [{
                name: "New layer",
                isVisible: true,
                isExpanded: true,
                shapes: []
            }],
        selectedLayerId: 0
    },
    newLayer: {
        name: "Untitled layer",
        isVisible: true,
        isExpanded: true,
        shapes: []
    },
    tools: {
        moveTool: {
            icon: "icon-handdrag",
            title: "Move tool",
            isSelectable: true
        },
        addMarkerTool: {
            icon: "icon-map-marker",
            title: "Add marker",
            isSelectable: true
        },
        addLineTool: {
            icon: "icon-line",
            title: "Add polyline",
            isSelectable: true
        },
        addDirectionTool: {
            icon: "icon-directions",
            title: "Add route",
            isSelectable: false
        }
    },
    newMarker: {
        type: "marker",
        name: "Untitled point",
        icon: "icon-map-marker",
        isVisible: true
    },
    newDirections: {
        type: "directions",
        destinations: ["", ""],
        editing: true,
        isVisible: true,
        avoidHighways: false,
        avoidTolls: false
    },
    defaultSearchZoom: 17,
    cookiesEnabled: false
});
