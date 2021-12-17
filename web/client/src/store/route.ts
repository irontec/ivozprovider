import { Action, action } from 'easy-peasy';
import { CriteriaFilterValues } from 'lib/components/List/Filter/ContentFilter';
import { JsxElement } from 'typescript';

const route = {
  route: '/',
  name: '',
  queryStringCriteria: [],
  // actions
  setRoute: action<RouteState, string>((state: any, route: string) => {
    state.route = route;
  }),
  setName: action<RouteState, string>((state: any, name: string | JsxElement) => {
    state.name = name;
  }),
  setQueryStringCriteria: action<RouteState, CriteriaFilterValues>((state: any, queryStringCriteria: CriteriaFilterValues) => {
    state.queryStringCriteria = queryStringCriteria;
  })
};

export default route;

interface RouteState {
  route: string,
  name: string,
  queryStringCriteria: CriteriaFilterValues
}

interface RouteActions {
  setRoute: Action<RouteState, string>,
  setName: Action<RouteState, string | JsxElement>,
  setQueryStringCriteria: Action<RouteState, CriteriaFilterValues>,
}

export type RouteStore = RouteState & RouteActions;