import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

import { ClientFeatures } from '../Company/ClientFeatures';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { useDefaultProxyTrunk } from './hooks/useDefaultProxyTrunk';

const Form = (props: EntityFormProps): JSX.Element => {
  const { create, entityService, row, match } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  useDefaultProxyTrunk({
    create,
    formik,
    choices: fkChoices.proxyTrunk,
  });
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const hasBillingFeature = aboutMe?.features.includes(ClientFeatures.billing);

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: [
        'name',
        'description',
        'proxyTrunk',
        // 'mediaRelaySet', @todo missing field
      ],
    },
    {
      legend: _('Extra Configuration'),
      fields: [
        'transformationRuleSet',
        hasBillingFeature && 'calculateCost',
        hasBillingFeature && 'currency',
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
