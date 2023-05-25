import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import entities from '../entities';
import { AboutMe } from '../store/clientSession/aboutMe';

type isAccessibleType = (aboutMe: AboutMe) => boolean;
export type ExtendedRouteMapItem = RouteMapItem & {
  isAccessible?: isAccessibleType;
};
export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
    {
      label: _('Global Configuration'),
      children: [
        {
          entity: entities.Brand,
          children: [
            {
              entity: entities.Administrator,
              filterBy: 'brand',
            },
            ...Object.values(entities.Brand.customActions),
            {
              entity: entities.WebPortal,
              filterBy: 'brand',
            },
          ],
        },
        {
          entity: entities.Administrator,
          filterBy: 'company',
          children: [
            {
              entity: entities.AdministratorRelPublicEntity,
              filterBy: 'administrator',
            },
          ],
        },
        {
          entity: entities.BannedAddress,
        },
        {
          entity: entities.TerminalManufacturer,
          children: [
            {
              entity: entities.TerminalModel,
              filterBy: 'terminalManufacturer',
            },
          ],
        },
        {
          entity: entities.Service,
        },
        {
          entity: entities.Currency,
        },
        {
          entity: entities.NotificationTemplate,
          children: [
            {
              entity: entities.NotificationTemplateContent,
              filterBy: 'notificationTemplate',
            },
          ],
        },
        {
          entity: entities.InvoiceTemplate,
        },
        {
          entity: entities.SpecialNumber,
        },
        {
          entity: entities.Domain,
        },
        {
          entity: entities.WebPortal,
        },
        {
          entity: entities.ActiveCalls,
        },
        {
          entity: entities.BillableCall,
        },
      ],
    },
    {
      label: _('Infrastructure'),
      children: [
        {
          entity: entities.ProxyUser,
        },
        {
          entity: entities.ProxyTrunk,
        },
        {
          entity: entities.MediaRelaySet,
          children: [
            {
              entity: entities.Rtpengine,
              filterBy: 'mediaRelaySet',
            },
          ],
        },
        {
          entity: entities.ApplicationServer,
        },
      ],
    },
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
