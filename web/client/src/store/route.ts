import { Action, action, computed, Computed, Thunk, thunk } from 'easy-peasy';
import { CriteriaFilterValue, CriteriaFilterValues } from 'lib/components/List/Filter/ContentFilter';

type DirectionType = 'asc' | 'desc';

export interface RouteOrderState {
  name: string,
  direction: DirectionType
}

interface RouteState {
  queryStringCriteria: CriteriaFilterValues,
  order: Computed<RouteState, RouteOrderState | null>,
  itemsPerPage: Computed<RouteState, number>,
  page: Computed<RouteState, number>,
}

interface RouteActions {
  setQueryStringCriteria: Action<RouteState, CriteriaFilterValues>,
  replaceInQueryStringCriteria: Thunk<RouteStore, CriteriaFilterValue, unknown>
}

export type RouteStore = RouteState & RouteActions;

export const ROUTE_ORDER_KEY = '_order';
export const ROUTE_ITEMS_PER_PAGE_KEY = '_itemsPerPage';
export const ROUTE_PAGE_KEY = '_page';


const route: RouteStore = {
  queryStringCriteria: [],
  order: computed<RouteState, RouteOrderState | null>((state) => {
    for (const criteria of state.queryStringCriteria) {
      if (criteria.name === ROUTE_ORDER_KEY) {
        const order : RouteOrderState = {
          name: criteria.type,
          direction: criteria.value as DirectionType
        };

        return order;
      }
    }

    return null;
  }),
  itemsPerPage: computed<RouteState, number>((state) => {
    for (const criteria of state.queryStringCriteria) {
      if (criteria.name === ROUTE_ITEMS_PER_PAGE_KEY) {
        return parseInt(criteria.value as string, 10);
      }
    }

    return 25;
  }),
  page: computed<RouteState, number>((state) => {
    for (const criteria of state.queryStringCriteria) {
      if (criteria.name === ROUTE_PAGE_KEY) {
        return parseInt(criteria.value as string, 10);
      }
    }

    return 1;
  }),
  // actions
  setQueryStringCriteria: action<RouteState, CriteriaFilterValues>((state: any, queryStringCriteria: CriteriaFilterValues) => {
    state.queryStringCriteria = [...queryStringCriteria];
  }),

  // thunks
  replaceInQueryStringCriteria: thunk<RouteStore, CriteriaFilterValue, unknown>(
    async (actions, criteria: CriteriaFilterValue, { getState }) => {
      const queryStringCriteria = [...getState().queryStringCriteria];

      let replaced = false;
      for (const idx in queryStringCriteria) {

        if (queryStringCriteria[idx].name !== criteria.name) {
          continue;
        }

        queryStringCriteria[idx] = criteria;
        replaced = true;
        break;
      }

      if (!replaced) {
        queryStringCriteria.push(criteria);
      }

      actions.setQueryStringCriteria(queryStringCriteria);
    }
  )
};

export default route;