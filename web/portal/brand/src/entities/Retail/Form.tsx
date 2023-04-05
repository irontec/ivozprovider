import { DropdownArrayChoices, EntityValues } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
  PropertyFkChoices,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

//TODO merge this into Company/Form
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

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  if (fkChoices.featureIds && aboutMe?.features) {
    const filteredFeatures: PropertyFkChoices = [];
    for (const feature of fkChoices.featureIds as DropdownArrayChoices) {
      if (!aboutMe?.features.includes(feature.extraData?.iden as string)) {
        continue;
      }

      if (feature.extraData?.iden === 'faxes') {
        continue;
      }

      filteredFeatures.push(feature);
    }

    fkChoices.featureIds = filteredFeatures;
  }

  const formik = useFormHandler(props);
  const hasInvoicesFeature = aboutMe?.features.includes('invoices') || false;
  const hasBillingFeature = aboutMe?.features.includes('billing') || false;

  const featureIds = (fkChoices.featureIds as EntityValues[]) || [];
  const recordingFeatureId = featureIds.find(
    (row: EntityValues) => (row.extraData as EntityValues).iden === 'recordings'
  )?.id as number | null;
  const recordingEnabled =
    formik.values.featureIds.includes(recordingFeatureId);

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        hasBillingFeature && 'billingMethod',
        'outgoingDdi',
        'featureIds',
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
        'voicemailNotificationTemplate',
        hasInvoicesFeature && 'invoiceNotificationTemplate',
        'callCsvNotificationTemplate',
        'maxDailyUsageNotificationTemplate',
      ],
    },
    edit &&
      recordingEnabled && {
        legend: _('Recordings'),
        fields: ['allowRecordingRemoval'],
      },
    edit && {
      legend: _('Externally rater options'),
      fields: ['externallyextraopts'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
    />
  );
};

export default Form;
