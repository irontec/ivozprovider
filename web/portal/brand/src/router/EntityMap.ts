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

const denyAllAcl = {
  read: false,
  detail: false,
  create: false,
  update: false,
  delete: false,
};

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
    {
      label: _('Clients'),
      children: [
        {
          entity: entities.VirtualPbx,
          filterValues: {
            type: 'vpbx',
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
            },
            {
              entity: entities.BannedAddress,
              filterBy: 'company',
              filterValues: {
                blocker: 'ipfilter',
              },
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
              entity: entities.RatingProfile,
              filterBy: 'company',
            },
          ],
        },
        {
          entity: entities.Residential,
          filterValues: {
            type: 'residential',
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
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
              entity: entities.RatingProfile,
              filterBy: 'company',
            },
          ],
        },
        {
          entity: entities.Retail,
          filterValues: {
            type: 'retail',
          },
          fixedValues: {
            domainUsers: '__null__',
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
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
              entity: {
                ...entities.RatingProfile,
                columns: ['activationTime', 'routingTag', 'ratingPlanGroup'],
              },
              filterBy: 'company',
            },
          ],
        },
        {
          entity: entities.Wholesale,
          filterValues: {
            type: 'wholesale',
          },
          fixedValues: {
            domainUsers: '__null__',
          },
          children: [
            {
              entity: entities.Trusted,
              filterBy: 'company',
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
              entity: {
                ...entities.RatingProfile,
                columns: ['activationTime', 'routingTag', 'ratingPlanGroup'],
              },
              filterBy: 'company',
            },
          ],
        },
      ],
    },
    {
      label: _('Providers'),
      children: [
        {
          entity: entities.Carrier,
          children: [
            {
              entity: entities.CarrierServer,
              filterBy: 'carrier',
            },
            {
              entity: entities.RatingProfile,
              filterBy: 'carrier',
              //@TODO ${auth.brandFeatures.billing.enabled}
            },
            {
              entity: entities.BalanceMovement,
              filterBy: 'company',
              //@TODO ${auth.brandFeatures.billing.enabled}
            },
            {
              entity: entities.BalanceNotification,
              filterBy: 'carrier',
              //@TODO ${auth.brandFeatures.billing.enabled}
            },
            {
              entity: entities.BillableCall,
              filterBy: 'carrier',
            },
          ],
        },
        {
          entity: entities.DdiProvider,
          children: [
            {
              entity: entities.DdiProviderAddress,
              filterBy: 'ddiProvider',
            },
            {
              entity: entities.DdiProviderRegistration,
              filterBy: 'ddiProvider',
            },
            {
              entity: {
                ...entities.Ddi,
              },
              filterBy: 'ddiProvider',
            },
            {
              entity: entities.BillableCall,
              filterBy: 'ddiProvider',
            },
          ],
        },
        {
          entity: {
            ...entities.Ddi,
          },
          children: [
            {
              entity: entities.BillableCall,
              filterBy: 'carrier',
            },
          ],
        },
      ],
    },
    {
      label: _('Routing'),
      children: [
        {
          entity: entities.OutgoingRouting,
        },
        {
          entity: entities.RoutingPattern,
        },
        {
          entity: entities.RoutingPatternGroup,
        },
        {
          entity: entities.RoutingTag,
        },
      ],
    },
    {
      label: _('Billing'),
      children: [
        {
          entity: entities.RatingPlanGroup,
          children: [
            {
              entity: entities.RatingPlan,
              filterBy: 'ratingPlanGroup',
            },
          ],
        },
        {
          entity: entities.DestinationRateGroup,
          children: [
            {
              entity: entities.DestinationRate,
              filterBy: 'destinationRateGroup',
            },
            //@TODO import rates
          ],
        },
        {
          entity: entities.Destination,
        },
        {
          entity: entities.CompanyBalances,
          filterValues: {
            billingMethod: 'prepaid', //@TODO: ['prepaid', 'pseudoprepaid'],
          },
          children: [
            {
              entity: entities.BalanceMovement,
              filterBy: 'company',
              //@TODO ${auth.brandFeatures.billing.enabled}
            },
            {
              entity: entities.BalanceNotification,
              filterBy: 'company',
              //@TODO ${auth.brandFeatures.billing.enabled}
            },
            //@TODO BalanceOperations
          ],
        },
        {
          entity: entities.CompanyCurrentDayUsage,
        },
      ],
    },
    {
      label: _('Invoice', { count: 1 }),
      children: [
        {
          entity: entities.Invoice,
          children: [
            {
              entity: entities.FixedCostsRelInvoice,
              filterBy: 'invoice',
            },
            {
              entity: entities.BillableCall,
              filterBy: 'invoice',
            },
            //@TODO generate invoice
          ],
        },
        {
          entity: entities.InvoiceScheduler,
          children: [
            {
              entity: entities.FixedCostsRelInvoiceScheduler,
              filterBy: 'invoiceScheduler',
            },
            {
              entity: entities.Invoice,
              filterBy: 'scheduler',
              children: [
                {
                  entity: entities.FixedCostsRelInvoice,
                  filterBy: 'invoice',
                },
                {
                  entity: entities.BillableCall,
                  filterBy: 'invoice',
                },
                //@TODO generate invoice
              ],
            },
          ],
        },
        {
          entity: entities.InvoiceNumberSequence,
        },
        {
          entity: entities.FixedCost,
        },
        {
          entity: entities.InvoiceTemplate,
          children: [
            //@TODO template testing
          ],
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
          children: [
            //@TODO rerate call
          ],
        },
        {
          entity: entities.CallCsvScheduler,
          children: [
            {
              entity: entities.CallCsvReport,
              filterBy: 'callCsvScheduler',
            },
          ],
        },
      ],
    },
    {
      label: _('Settings'),
      children: [
        {
          entity: entities.WebPortal,
        },
        {
          entity: entities.SpecialNumber,
        },
        {
          entity: entities.TransformationRuleSet,
          children: [
            {
              entity: entities.CallerInTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'callerin',
              },
            },
            {
              entity: entities.CalleeInTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'calleein',
              },
            },
            {
              entity: entities.CallerOutTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'callerout',
              },
            },
            {
              entity: entities.CalleeOutTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'calleeout',
              },
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
        {
          entity: entities.MusicOnHold,
        },
        {
          entity: entities.BrandService,
        },
        {
          entity: entities.MatchList,
          children: [
            {
              entity: entities.MatchListPattern,
              filterBy: 'matchList',
            },
          ],
        },
      ],
    },
    {
      label: _('Views'),
      children: [
        {
          entity: {
            ...entities.RetailAccount,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
        },
        {
          entity: {
            ...entities.ResidentialDevice,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
        },
        {
          entity: {
            ...entities.User,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
        },
        {
          entity: {
            ...entities.BannedAddress,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
          filterValues: {
            blocker: 'ipfilter',
          },
        },
        {
          entity: {
            ...entities.BannedAddressBruteForce,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
          filterValues: {
            blocker: 'antibruteforce',
          },
        },
      ],
    },
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
