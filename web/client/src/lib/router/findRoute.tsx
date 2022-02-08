import { RouteMap, RouteMapItem } from './routeMapParser';
import { match } from 'react-router-dom';

const _findRoute = (route: RouteMapItem, match: match): RouteMapItem | undefined => {

    if (route.route === match.path) {
        return route;
    }

    if (route.children) {
        for (const child of route.children) {
            const resp = _findRoute(child, match);
            if (resp) {
                return resp;
            }
        }
    }
}

const findRoute = (routeMap: RouteMap, match: match): RouteMapItem | undefined => {
    for (const item of routeMap) {
        for (const child of item.children) {
            const resp = _findRoute(child, match);
            if (resp) {
                return resp;
            }
        }
    }
}

export default findRoute;