import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import CallSplitIcon from '@mui/icons-material/CallSplit';

import Operator from './Field/Operator';
import {
  OutgoingRoutingProperties,
  OutgoingRoutingPropertyList,
} from './OutgoingRoutingProperties';

const properties: OutgoingRoutingProperties = {
  type: {
    label: _('Type'),
    enum: {
      pattern: _('Pattern'),
      group: _('Group'),
      fax: _('Fax', { count: 1 }),
    },
    visualToggle: {
      pattern: {
        show: ['routingPattern'],
        hide: ['routingPatternGroup'],
      },
      group: {
        show: ['routingPatternGroup'],
        hide: ['routingPattern'],
      },
      fax: {
        show: [],
        hide: ['routingPattern', 'routingPatternGroup'],
      },
    },
  },
  priority: {
    label: _('Priority'),
    default: 1,
    minimum: 0,
    maximum: 254,
  },
  weight: {
    label: _('Weight'),
    default: 1,
    minimum: 1,
    maximum: 20,
  },
  routingMode: {
    label: _('Route type'),
    enum: {
      static: _('Static'),
      lcr: _('LCR'),
      block: _('Block'),
    },
    visualToggle: {
      static: {
        show: [
          'carrier',
          'prefix',
          'forceClid',
          'clidCountry',
          'clid',
          'weight',
          'priority',
        ],
        hide: ['carrierIds'],
      },
      lcr: {
        show: ['carrierIds', 'weight', 'priority'],
        hide: ['carrier', 'prefix', 'forceClid', 'clidCountry', 'clid'],
      },
      block: {
        show: ['priority'],
        hide: [
          'carrier',
          'prefix',
          'forceClid',
          'clidCountry',
          'clid',
          'carrierIds',
          'weight',
          'stopper',
        ],
      },
    },
  },
  prefix: {
    label: _('Destination prefix'),
    maxLength: 25,
    helpText: _(
      `This prefix will be added to the callee after carrier's numeric transformations.`
    ),
  },
  stopper: {
    label: _('Stopper'),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    helpText: _(
      `Routes with higher priority won't be evaluated. Those with same priority will be evaluated.`
    ),
  },
  forceClid: {
    label: _('Force CLID'),
    helpText: _(
      `Instead of getting the caller from PAI/RPID headers, this clid will be used (and will be adapted using carrier's numeric transformations).`
    ),
    default: 0,
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    visualToggle: {
      '0': {
        show: [],
        hide: ['clid', 'clidCountry'],
      },
      '1': {
        show: ['clid', 'clidCountry'],
        hide: [],
      },
    },
  },
  clid: {
    label: _('Clid'),
    maxLength: 25,
  },
  company: {
    label: _('Client'),
    null: _('Apply to all clients'),
  },
  destination: {
    label: _('Destination', { count: 1 }),
    memoize: false,
  },
  carrier: {
    label: _('Carrier', { count: 1 }),
    component: Operator,
  },
  carrierIds: {
    label: _('Carrier', { count: 2 }),
    type: 'array',
    $ref: '#/definitions/Carrier',
  },
  routingPattern: {
    label: _('Select destination pattern'),
  },
  routingPatternGroup: {
    label: _('Select destination group'),
  },
  routingTag: {
    label: _('Routing Tag', { count: 1 }),
    null: _('Unassigned'),
  },
  clidCountry: {
    label: _('Country', { count: 1 }),
  },
  carriers: {
    label: _('Carrier', { count: 1 }),
    //@TODO IvozProvider_Klear_Ghost_OutgoingRouting::getCarriers
  },
};

const OutgoingRouting: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CallSplitIcon,
  link: '/doc/en/administration_portal/brand/routing/outgoing_routings.html',
  iden: 'OutgoingRouting',
  title: _('Outgoing Routing', { count: 2 }),
  path: '/outgoing_routings',
  toStr: (row: OutgoingRoutingPropertyList<EntityValues>) => `${row.id}`,
  properties,
  columns: [
    'company',
    'routingTag',
    'type',
    'destination',
    'routingMode',
    'carrier',
    'priority',
    'weight',
    'stopper',
  ],
  selectOptions: async () => {
    const module = await import('./SelectOptions');

    return module.default;
  },
  foreignKeyResolver: async () => {
    const module = await import('./ForeignKeyResolver');

    return module.default;
  },
  foreignKeyGetter: async () => {
    const module = await import('./ForeignKeyGetter');

    return module.foreignKeyGetter;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default OutgoingRouting;
