import entities from '../entities';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';
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
          entity: entities.TerminalManufacturer,
          children: [
            {
              entity: entities.TerminalModel,
            },
          ],
        },
        { entity: entities.Service },
        {
          entity: entities.Currency,
        },
        {
          entity: entities.Brand,
          children: [
            {
              entity: entities.Administrator,
            },
          ],
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
      ],
    },
    {
      label: _('Clients'),
      children: [
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
      ],
    },
    {
      label: _('Invoicing'),
      children: [
        {
          entity: entities.InvoiceTemplate,
        },
      ],
    },
    {
      label: _('Calls'),
      children: [
        {
          entity: entities.ActiveCalls,
        },
        {
          entity: entities.BillableCall,
        },
      ],
    },
    {
      label: _('Settings'),
      children: [
        { entity: entities.SpecialNumber },
        {
          entity: entities.WebPortal,
        },
      ],
    },
    {
      label: _('Views'),
      children: [
        {
          entity: entities.Domain,
        },
        {
          entity: entities.BannedAddress,
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
