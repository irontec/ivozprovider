import routeMapParser, {
  RouteMap,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import entities from 'entities/index';

export type ExtendedRouteMap = RouteMap;

const getEntityMap = (): RouteMap => {
  const map: RouteMap = [
    {
      label: _('Calls'),
      children: [
        {
          entity: entities.UsersCdr,
        },
        {
          entity: entities.CallForwardSetting,
        },
      ],
    },
    {
      label: _('Configuration'),
      children: [
        {
          entity: entities.Account,
        },
        {
          entity: entities.Preferences,
        },
      ],
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
