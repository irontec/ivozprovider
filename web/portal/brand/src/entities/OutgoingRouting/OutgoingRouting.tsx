import CallSplitIcon from '@mui/icons-material/CallSplit';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import selectOptions from './SelectOptions';
import Form from './Form';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { OutgoingRoutingProperties } from './OutgoingRoutingProperties';
import foreignKeyResolver from './ForeignKeyResolver';
import Operator from './Field/Operator';

const properties: OutgoingRoutingProperties = {
  type: {
    label: _('Type'),
    enum: {
      pattern: _('Pattern'),
      group: _('Group'),
      fax: _('Fax'),
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
        hide: ['relCarriers'],
      },
      lcr: {
        show: ['relCarriers', 'carrier', 'weight', 'priority'],
        hide: ['prefix', 'forceClid', 'clidCountry', 'clid'],
      },
      block: {
        show: ['priority'],
        hide: [
          'carrier',
          'prefix',
          'forceClid',
          'clidCountry',
          'clid',
          'relCarriers',
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
    label: _('Force Clid'),
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
    label: _('Destination'),
    memoize: false,
  },
  carrier: {
    label: _('Carrier'),
    component: Operator,
  },
  routingPattern: {
    label: _('Select destination pattern'),
  },
  routingPatternGroup: {
    label: _('Select destination group'),
  },
  routingTag: {
    label: _('Routing Tag'),
    null: _('Unassigned'),
  },
  clidCountry: {
    label: _('Country'),
  },
  carrierIds: {
    label: _('Carrier'),
    //@TODO
  },
  //@TODO relCarriers
  carriers: {
    label: _('Carrier'),
    //@TODO IvozProvider_Klear_Ghost_OutgoingRouting::getCarriers
  },
};

const OutgoingRouting: EntityInterface = {
  ...defaultEntityBehavior,
  icon: CallSplitIcon,
  iden: 'OutgoingRouting',
  title: _('Outgoing Routing', { count: 2 }),
  path: '/outgoing_routings',
  toStr: (row: any) => row.id,
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
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default OutgoingRouting;
