import routeMapParser, {
  RouteMap,
} from '@irontec/ivoz-ui/router/routeMapParser';

import entities from '../entities/index';

export type ExtendedRouteMap = RouteMap;

const getEntityMap = (): RouteMap => {
  const map: RouteMap = [
    {
      entity: {
        ...entities.UsersCdr,
        acl: {
          ...entities.UsersCdr.acl,
          detail: false,
        },
      },
      divider: true,
    },
    {
      entity: entities.Account,
      divider: true,
    },
    {
      entity: entities.Preferences,
    },
    {
      entity: entities.CallForwardSetting,
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
