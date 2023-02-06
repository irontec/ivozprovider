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
      label: _('Global'),
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
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
