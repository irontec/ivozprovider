import routeMapParser, {
  ActionItem,
  EntityItem,
  RouteMap,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DialpadIcon from '@mui/icons-material/Dialpad';
import PhonelinkSetupIcon from '@mui/icons-material/PhonelinkSetup';
import SwapCallsIcon from '@mui/icons-material/SwapCalls';

import entities from '../entities';
import { AboutMe } from '../store/clientSession/aboutMe';

type isAccessibleType = (aboutMe: AboutMe) => boolean;

export type isAccesibleCallBack = { isAccessible?: isAccessibleType };

export type ExtendedRouteMapItem =
  | (EntityItem & isAccesibleCallBack)
  | (ActionItem & isAccesibleCallBack);
export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
    {
      entity: entities.Brand,
      divider: true,
      children: [
        ...Object.values(entities.Brand.customActions),
        {
          entity: {
            ...entities.Administrator,
            title: _('Brand operator', { count: 2 }),
            link: '/doc/en/administration_portal/platform/brands.html#brand-operators',
          },
          filterBy: 'brand',
          children: [
            {
              entity: entities.AdministratorRelPublicEntity,
              filterBy: 'administrator',
            },
          ],
        },
        {
          entity: {
            ...entities.WebPortal,
            title: _('Brand Portal', { count: 2 }),
          },
          filterBy: 'brand',
          fixedValues: {
            urlType: 'brand',
          },
        },
      ],
    },
    {
      entity: entities.Domain,
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
      entity: entities.WebPortal,
      filterValues: {
        urlType: 'god',
      },
      divider: true,
    },
    {
      entity: entities.Administrator,
      filterValues: {
        'brand[exists]': false,
      },
      children: [
        {
          entity: entities.AdministratorRelPublicEntity,
          filterBy: 'administrator',
        },
      ],
    },
    {
      label: _('Generic Configuration'),
      icon: PhonelinkSetupIcon,
      children: [
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
      ],
    },
    {
      label: _('Infrastructure'),
      icon: SwapCallsIcon,
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
    {
      label: _('Calls'),
      icon: DialpadIcon,
      children: [
        {
          entity: entities.ActiveCalls,
        },
        {
          entity: entities.BillableCall,
          children: [...Object.values(entities.BillableCall.customActions)],
        },
      ],
    },
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
