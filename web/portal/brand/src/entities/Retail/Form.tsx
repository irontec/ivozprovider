import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, foreignKeyGetter } = props;
  const edit = props.edit || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'billingMethod', 'outgoingDdi', 'featureIds'],
    },
    {
      legend: _('Security'),
      fields: [
        'maxCalls',
        'maxDailyUsage',
        'maxDailyUsageEmail',
        'ipfilter',
        'geoIpAllowedCountries',
      ],
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
      legend: _('Retail specific'),
      fields: ['routingTagIds', 'codecIds'],
    },
    edit && {
      legend: _('Invoice data'),
      fields: [
        'showInvoices',
        'nif',
        'postalAddress',
        'postalCode',
        'town',
        'province',
        'countryName',
      ],
    },
    edit && {
      legend: _('Notification options'),
      fields: [
        'voicemailNotificationTemplate',
        'faxNotificationTemplate',
        'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
      ],
    },
    edit && {
      legend: _('Recordings'),
      fields: ['allowRecordingRemoval'],
    },
    edit && {
      legend: _('Externally rater options'),
      fields: ['externallyextraopts'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
