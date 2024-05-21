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
      entity: entities.Fax,
      children: [
        {
          entity: entities.FaxesOut,
          filterBy: 'fax',
          filterValues: {
            'type[exact]': 'Out',
          },
          children: [...Object.values(entities.FaxesOut.customActions)],
        },
        {
          entity: entities.FaxesIn,
          filterBy: 'fax',
          filterValues: {
            'type[exact]': 'In',
          },
        },
      ],
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
