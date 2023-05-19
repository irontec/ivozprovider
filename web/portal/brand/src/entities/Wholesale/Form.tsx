import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

//TODO merge this into Company/Form
const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, foreignKeyGetter } = props;
  const edit = props.edit || false;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const hasInvoicesFeature = aboutMe?.features.includes('invoices') || false;
  const hasBillingFeature = aboutMe?.features.includes('billing') || false;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', hasBillingFeature && 'billingMethod'],
    },
    {
      legend: _('Security'),
      fields: ['maxCalls', 'maxDailyUsage', 'maxDailyUsageEmail'],
    },
    {
      legend: _('Geographic Configuration'),
      fields: [
        'language',
        'country',
        'defaultTimezone',
        'transformationRuleSet',
        'currency',
      ],
    },
    edit && {
      legend: _('Wholesale specific'),
      fields: ['routingTagIds', 'codecIds'],
    },
    edit &&
      hasInvoicesFeature && {
        legend: _('Invoice data'),
        fields: [
          'showInvoices',
          'invoicing.nif',
          'invoicing.postalAddress',
          'invoicing.postalCode',
          'invoicing.town',
          'invoicing.province',
          'invoicing.countryName',
        ],
      },
    edit && {
      legend: _('Notification options'),
      fields: [
        hasInvoicesFeature && 'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
      ],
    },
    edit && {
      legend: _('Externally rater options'),
      fields: ['externallyextraopts'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
