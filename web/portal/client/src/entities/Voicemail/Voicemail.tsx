import { isEntityItem } from '@irontec/ivoz-ui';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import { EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MailIcon from '@mui/icons-material/Mail';

import { VoicemailProperties } from './VoicemailProperties';

const properties: VoicemailProperties = {
  enabled: {
    label: _('Enabled'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
  },
  name: {
    label: _('Name'),
    required: true,
  },
  sendMail: {
    label: _('Voicemail send mail'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
    visualToggle: {
      '0': {
        show: [],
        hide: ['attachSound', 'email'],
      },
      '1': {
        show: ['attachSound', 'email'],
        hide: [],
      },
    },
  },
  email: {
    label: _('Email'),
    required: true,
  },
  attachSound: {
    label: _('Voicemail attach sound'),
    enum: {
      '0': _('No'),
      '1': _('Yes'),
    },
    default: '1',
  },
  locution: {
    label: _('Locution', { count: 1 }),
    null: _('Unassigned'),
    default: '__null__',
  },
};

const columns = ['enabled', 'name', 'email'];

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  if (
    isEntityItem(routeMapItem) &&
    routeMapItem.entity.iden === Voicemail.iden
  ) {
    const isDeletePath = routeMapItem.route === `${Voicemail.path}/:id`;
    const allowDelete = row.user === null && row.residential === null;
    if (isDeletePath && !allowDelete) {
      return null;
    }
  }

  return DefaultChildDecorator(props);
};

const Voicemail: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MailIcon,
  link: '/doc/en/administration_portal/client/vpbx/voicemails.html',
  iden: 'Voicemail',
  title: _('Voicemail', { count: 2 }),
  path: '/voicemails',
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Voicemails',
  },
  toStr: (row: EntityValues) => (row.name as string) || '',
  properties,
  columns,
  selectOptions: async () => {
    const module = await import('./EnabledVoicemailSelectOptions');

    return module.default;
  },
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
  ChildDecorator,
};

export default Voicemail;
