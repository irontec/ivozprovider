import EditRowButton from '@irontec/ivoz-ui/components/List/Content/CTA/EditRowButton';
import defaultEntityBehavior, {
  ChildDecorator as DefaultChildDecorator,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface, {
  ChildDecoratorType,
} from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import MailIcon from '@mui/icons-material/Mail';

import {
  VoicemailProperties,
  VoicemailPropertyList,
} from './VoicemailProperties';

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
};

export const ChildDecorator: ChildDecoratorType = (props) => {
  const { routeMapItem, row } = props;

  const isUpdatePath = routeMapItem.route === `${voicemail.path}/:id/update`;

  if (row.generic && isUpdatePath) {
    return <EditRowButton disabled={true} row={row} />;
  }

  return DefaultChildDecorator(props);
};

const columns = ['enabled', 'name', 'email'];

const voicemail: EntityInterface = {
  ...defaultEntityBehavior,
  icon: MailIcon,
  iden: 'Voicemail',
  title: _('Voicemail', { count: 2 }),
  path: '/my/voicemails',

  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'Voicemails',
  },
  toStr: (row: VoicemailPropertyList<string>) => `${row.name as string}`,
  properties,
  ChildDecorator,
  columns,
  defaultOrderBy: '',
  Form: async () => {
    const module = await import('./Form');

    return module.default;
  },
};

export default voicemail;
