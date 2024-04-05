import routeMapParser, {
  RouteMap,
} from '@irontec/ivoz-ui/router/routeMapParser';

import entities from '../entities/index';

export type ExtendedRouteMap = RouteMap;

const getEntityMap = (): RouteMap => {
  const map: RouteMap = [
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
    {
      entity: entities.Voicemail,
      children: [
        {
          entity: entities.VoicemailMessage,
          filterBy: 'voicemail',
        },
      ],
      divider: true,
    },
    {
      entity: {
        ...entities.UsersCdr,
        acl: {
          ...entities.UsersCdr.acl,
          detail: false,
        },
      },
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
