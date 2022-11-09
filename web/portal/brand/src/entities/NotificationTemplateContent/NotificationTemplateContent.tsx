import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import EntityInterface from '@irontec/ivoz-ui/entities/EntityInterface';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import ArticleIcon from '@mui/icons-material/Article';
import { foreignKeyGetter } from './ForeignKeyGetter';
import foreignKeyResolver from './ForeignKeyResolver';
import Form from './Form';
import { NotificationTemplateContentProperties } from './NotificationTemplateContentProperties';
import selectOptions from './SelectOptions';

const properties: NotificationTemplateContentProperties = {
  fromName: {
    label: _('From name'),
    maxLength: 255,
    helpText: _(
      'Name shown as source when sending mails (e.g. IvozProvider Notifications)'
    ),
  },
  fromAddress: {
    label: _('From address'),
    maxLength: 255,
    helpText: _(
      'Mail address shown as source when sending mails. MTA must allow this value.'
    ),
  },
  voicemailVariables: {
    label: _('Substitution variables'),
    maxLength: 255,
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
  },
  faxVariables: {
    label: _('Substitution variables'),
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
  },
  invoiceVariables: {
    label: _('Substitution variables'),
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
  },
  lowBalanceVariables: {
    label: _('Substitution variables'),
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
  },
  callCsvVariables: {
    label: _('Substitution variables'),
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
  },
  maxDailyUsageVariables: {
    label: _('Substitution variables'),
    //@TODO IvozProvider_Klear_Ghost_NotificationTemplate::getVariables
    //@TODO massive helpText
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
    label: _('Notification Template'),
  },
  language: {
    label: _('Language'),
  },
};

const NotificationTemplateContent: EntityInterface = {
  ...defaultEntityBehavior,
  icon: ArticleIcon,
  iden: 'NotificationTemplateContent',
  title: _('Notification template content', { count: 2 }),
  path: '/notification_template_contents',
  toStr: (row: any) => row.id,
  properties,
  columns: ['language', 'fromName', 'fromAddress'],
  selectOptions,
  foreignKeyResolver,
  foreignKeyGetter,
  Form,
};

export default NotificationTemplateContent;
