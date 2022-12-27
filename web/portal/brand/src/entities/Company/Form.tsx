import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, foreignKeyGetter, formik } = props;
  const edit = props.edit || false;

  const DefaultEntityForm = defaultEntityBehavior.Form;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const recordingFeatureId = fkChoices.featureIds?.find(
    (row) => row.extraData.iden === 'recordings'
  ).id;
  const recordingEnabled =
    formik.values.featureIds.includes(recordingFeatureId);

  const faxFeatureId = fkChoices.featureIds?.find(
    (row) => row.extraData.iden === 'faxes'
  ).id;
  const faxEnabled = formik.values.featureIds.includes(faxFeatureId);

  const type = row?.type ?? props.formik.initialValues.type;
  const isVpbx = type === 'vpbx';
  const isResidential = type === 'residential';

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        isVpbx && 'domainUsers',
        'featureIds',
        'billingMethod',
        isResidential && 'outgoingDdi',
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
    edit && {
      legend: _('Retail specific'),
      fields: ['routingTagIds', 'codecIds'],
    },
    edit &&
      !isResidential && {
        legend: _('Platform data'),
        fields: ['outgoingDdi', 'outgoingDdiRule'],
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
    edit &&
      recordingEnabled && {
        legend: _('Recordings'),
        fields: [
          'onDemandRecord',
          'allowRecordingRemoval',
          'onDemandRecordCode',
        ],
      },
    edit && {
      legend: _('Notification options'),
      fields: [
        'voicemailNotificationTemplate',
        faxEnabled && 'faxNotificationTemplate',
        'invoiceNotificationTemplate',
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
