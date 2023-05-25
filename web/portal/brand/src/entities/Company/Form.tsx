import { DropdownArrayChoices, EntityValues } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  PropertyFkChoices,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element | null => {
  const { entityService, row, match } = props;
  const edit = props.edit || false;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  if (fkChoices.featureIds && aboutMe?.features) {
    const filteredFeatures: PropertyFkChoices = [];
    for (const feature of fkChoices.featureIds as DropdownArrayChoices) {
      if (!aboutMe?.features.includes(feature.extraData?.iden as string)) {
        continue;
      }
      filteredFeatures.push(feature);
    }

    fkChoices.featureIds = filteredFeatures;
  }

  const formik = useFormHandler(props);
  const hasInvoicesFeature = aboutMe?.features.includes('invoices');
  const hasBillingFeature = aboutMe?.features.includes('billing');

  const featureIds = (fkChoices.featureIds as EntityValues[]) || [];
  const recordingFeatureId = featureIds.find(
    (row: EntityValues) => (row.extraData as EntityValues).iden === 'recordings'
  )?.id as number | null;
  const recordingEnabled =
    formik.values.featureIds.includes(recordingFeatureId);

  const faxFeatureId = featureIds.find(
    (row: EntityValues) => (row.extraData as EntityValues).iden === 'faxes'
  )?.id as number | null;
  const faxEnabled = formik.values.featureIds.includes(faxFeatureId);

  const type = row?.type ?? formik.initialValues.type;
  const isVpbx = type === 'vpbx';
  const isResidential = type === 'residential';
  const isWholesale = type === 'wholesale';
  const isRetail = type === 'retail';

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        isVpbx && 'domainUsers',
        isVpbx && 'corporation',
        'featureIds',
        hasBillingFeature && 'billingMethod',
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
    isRetail && {
      legend: _('Retail specific'),
      fields: ['routingTagIds', edit && 'codecIds'],
    },
    isWholesale && {
      legend: _('Wholesale specific'),
      fields: ['routingTagIds', edit && 'codecIds'],
    },
    edit &&
      !isResidential && {
        legend: _('Platform data'),
        fields: ['outgoingDdi', 'outgoingDdiRule'],
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
