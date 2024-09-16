import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';

import entities from '../entities/index';
import { Status } from '../store/userStatus/status';

type isAccessibleType = (status: Status) => boolean;
export type ExtendedRouteMapItem = RouteMapItem & {
  isAccessible?: isAccessibleType;
};

export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
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
      isAccessible: (status) => status.features.includes('faxes'),
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
    {
      entity: {
        ...entities.Recording,
        acl: {
          ...entities.Recording.acl,
          update: false,
          detail: true,
        },
      },
    },
  ];

  return routeMapParser(map);
};

export default getEntityMap;
