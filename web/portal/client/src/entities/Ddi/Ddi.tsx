import { isEntityItem } from '@irontec/ivoz-ui';
import ChildEntityLink from '@irontec/ivoz-ui/components/List/Content/Shared/ChildEntityLink';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import DialpadIcon from '@mui/icons-material/Dialpad';
import { useStoreState } from 'store';

import { ClientFeatures } from '../../store/clientSession/aboutMe';
import Recording from '../Recording/Recording';
import { DdiProperties, DdiPropertyList } from './DdiProperties';
import RouteType from './Field/RouteType';

const allRoutableFields = [
  'ivr',
  'huntGroup',
  'user',
  'fax',
  'conferenceRoom',
  'friendValue',
  'queue',
  'residentialDevice',
  'conditionalRoute',
  'retailAccount',
];

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, entityService, row } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === Recording.iden
  ) {
    const hasRecordingsFeature = aboutMe?.features.includes(
      ClientFeatures.recordings
    );

    if (!hasRecordingsFeature) {
      return (
        <ChildEntityLink
          row={row}
          routeMapItem={routeMapItem}
          disabled={true}
        />
      );
    }
  }

  return DefaultChildDecorator(props);
};

const properties: DdiProperties = {
  ddi: {
    label: _('DDI', { count: 1 }),
  },
  ddie164: {
    label: _('DDI', { count: 1 }),
  },
  description: {
    label: _('Description'),
  },
  externalCallFilter: {
    label: _('External call filter', { count: 1 }),
    default: '__null__',
    null: _('Unassigned'),
  },
  routeType: {
    label: _('Route type'),
    component: RouteType,
    enum: {
      user: _('User', { count: 1 }),
      ivr: _('IVR', { count: 1 }),
      huntGroup: _('Hunt Group', { count: 1 }),
      fax: _('Fax', { count: 1 }),
      conferenceRoom: _('Conference room', { count: 1 }),
      friend: _('Friend', { count: 1 }),
      queue: _('Queue', { count: 1 }),
      residential: _('Residential Device', { count: 1 }),
      conditional: _('Conditional Route', { count: 1 }),
      retail: _('Retail Account', { count: 1 }),
    },
    null: _('Unassigned'),
    visualToggle: {
      __null__: {
        show: [],
        hide: allRoutableFields,
      },
      user: {
        show: ['user'],
        hide: allRoutableFields,
      },
      ivr: {
        show: ['ivr'],
        hide: allRoutableFields,
      },
      huntGroup: {
        show: ['huntGroup'],
        hide: allRoutableFields,
      },
      fax: {
        show: ['fax'],
        hide: allRoutableFields,
      },
      conferenceRoom: {
        show: ['conferenceRoom'],
        hide: allRoutableFields,
      },
      friend: {
        show: ['friendValue'],
        hide: allRoutableFields,
      },
      queue: {
        show: ['queue'],
        hide: allRoutableFields,
      },
      residential: {
        show: ['residentialDevice', 'recordCalls'],
        hide: allRoutableFields,
      },
      conditional: {
        show: ['conditionalRoute'],
        hide: allRoutableFields,
      },
      retail: {
        show: ['retailAccount'],
        hide: allRoutableFields,
      },
    },
  },
  recordCalls: {
    label: _('Record call'),
    helpText: _(
      'Local legislation may enforce to announce the call recording to both parties, act responsibly'
    ),
    enum: {
      none: _('None'),
      all: _('All'),
      inbound: _('Inbound'),
      outbound: _('Outbound'),
    },
    default: 'none',
  },
  displayName: {
    label: _('Display name'),
    helpText: _('This value will be displayed in the called terminals'),
  },
  user: {
    label: _('User', { count: 1 }),
  },
  ivr: {
    label: _('IVR', { count: 1 }),
  },
  huntGroup: {
    label: _('Hunt Group', { count: 1 }),
  },
  fax: {
    label: _('Fax', { count: 1 }),
  },
  conferenceRoom: {
    label: _('Conference room', { count: 1 }),
  },
  residentialDevice: {
    label: _('Residential Device', { count: 1 }),
  },
  friendValue: {
    label: _('Friend value'),
  },
  country: {
    label: _('Country', { count: 1 }),
  },
  language: {
    label: _('Language', { count: 1 }),
    null: _("Client's default"),
  },
  queue: {
    label: _('Queue', { count: 1 }),
  },
  conditionalRoute: {
    label: _('Conditional Route', { count: 1 }),
  },
  retailAccount: {
    label: _('Retail Account', { count: 1 }),
  },
  target: {
    label: _('Target'),
    memoize: false,
  },
};

const columns = [
  'ddie164',
  'externalCallFilter',
  'routeType',
  'target',
  'description',
];

const ddi: EntityInterface = {
  ...defaultEntityBehavior,
  icon: DialpadIcon,
  link: '/doc/en/administration_portal/client/vpbx/ddis.html',
  iden: 'Ddi',
  title: _('DDI', { count: 2 }),
  path: '/ddis',
  toStr: (row: DdiPropertyList<string>) => `${row.ddie164}`,
  columns,
  properties,
  defaultOrderBy: '',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'DDIs',
  },
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
  ChildDecorator,
};

export default ddi;
