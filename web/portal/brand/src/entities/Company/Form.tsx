import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, foreignKeyGetter } = props;
  const DefaultEntityForm = defaultEntityBehavior.Form;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const type = row?.type ?? '';
  const isVpbx = type === 'vpbx';
  const isRetail = type === 'retail';
  const isResidential = type === 'residential';

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        isVpbx && 'domainUsers',
        'featureIds',
        'billingMethod',
        (isResidential || isRetail) && 'outgoingDdi',
      ],
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
    isRetail && {
      legend: _('Retail specific'),
      fields: ['routingTagIds', 'codecIds'],
    },
    !isResidential && {
      legend: _('Platform data'),
      fields: ['outgoingDdi', 'outgoingDdiRule'],
    },
    {
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
    {
      legend: _('Recordings'),
      fields: [
        'onDemandRecord',
        'allowRecordingRemoval',
        !isRetail && 'onDemandRecordCode',
      ],
    },
    {
      legend: _('Notification options'),
      fields: [
        'voicemailNotificationTemplate',
        'faxNotificationTemplate',
        'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
      ],
    },
    {
      legend: _('Externally rater options'),
      fields: ['externallyextraopts'],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
