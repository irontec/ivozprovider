import { EntityValues } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ArticleIcon from '@mui/icons-material/Article';

import {
  NotificationTemplateContentProperties,
  NotificationTemplateContentPropertyList,
} from './NotificationTemplateContentProperties';

const properties: NotificationTemplateContentProperties = {
  fromName: {
    label: _('From name'),
    maxLength: 255,
    helpText: _(
      'Name shown as source when sending mails (e.g. IvozProvider Notifications)'
    ),
    required: true,
  },
  fromAddress: {
    label: _('From address'),
    maxLength: 255,
    helpText: _(
      'Mail address shown as source when sending mails. MTA must allow this value.'
    ),
    required: true,
  },
  subject: {
    label: _('Subject'),
    maxLength: 255,
  },
  body: {
    label: _('Body'),
    format: 'textarea',
    //@TODO codemirror
  },
  bodyType: {
    label: _('Body Type'),
    enum: {
      'text/plain': 'text/plain',
      'text/html': 'text/html',
    },
  },
  notificationTemplate: {
    label: _('Notification template', { count: 1 }),
  },
  language: {
    label: _('Language', { count: 1 }),
    required: true,
  },
};

const NotificationTemplateContent: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ArticleIcon,
  link: '/doc/${language}/administration_portal/brand/settings/notification_templates.html',
  iden: 'NotificationTemplateContent',
  title: _('Notification template content', { count: 2 }),
  path: '/notification_template_contents',
  toStr: (row: NotificationTemplateContentPropertyList<EntityValues>) =>
    `${row.id}`,
  properties,
  columns: ['language', 'fromName', 'fromAddress'],
  acl: {
    ...defaultEntityBehavior.acl,
    iden: 'NotificationTemplateContents',
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
  defaultOrderBy: '',
};

export default NotificationTemplateContent;
