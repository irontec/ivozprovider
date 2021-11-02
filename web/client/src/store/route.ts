import { Action, action } from 'easy-peasy';
import { JsxElement } from 'typescript';

interface RouteState {
  route: string,
  name: string,
}

interface RouteActions {
  setRoute: Action<RouteState, string>,
  setName: Action<RouteState, string | JsxElement>,
}

export type RouteStore = RouteState & RouteActions;

const route = {
  route: '/',
  name: '',

  // actions
  setRoute: action((state: any, route: string) => {
    state.route = route;
  }),
  setName: action((state: any, name: string | JsxElement) => {
    state.name = name;
  }),
};

export default route;
