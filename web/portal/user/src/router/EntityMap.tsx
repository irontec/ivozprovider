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
        {
          entity: entities.CallForwardSetting,
        },
      ],
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
