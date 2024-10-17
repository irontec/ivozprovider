import { DropdownArrayChoices } from '@irontec/ivoz-ui';
import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  const edit = props.edit || false;

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const enableSipDomainFeatures = (
    (fkChoices.features as DropdownArrayChoices) || []
  ).filter((row) =>
    ['residential', 'retail'].includes(row.extraData?.iden as string)
  );

  const enableSipDomainFeaturesIds = enableSipDomainFeatures.map(
    (row) => row.id
  );

  const formik = useFormHandler(props);
  const { values } = formik;
  const showDomainSipFlds =
    values.features.filter((id: number) =>
      enableSipDomainFeaturesIds.includes(id)
    ).length > 0;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        edit && 'invoice.nif',
        'proxyTrunks',
        'applicationServerSets',
        'mediaRelaySets',
        'features',
        edit && 'logo',
        'maxCalls',
      ],
    },
    {
      legend: _('Locales'),
      fields: ['defaultTimezone', 'language', 'currency'],
    },
    showDomainSipFlds && {
      legend: _('SIP domain', { count: 1 }),
      fields: ['domainUsers'],
    },
    edit && {
      legend: _('Invoice Data'),
      fields: [
        'invoice.postalAddress',
        'invoice.postalCode',
        'invoice.town',
        'invoice.province',
        'invoice.country',
        'invoice.registryData',
      ],
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
