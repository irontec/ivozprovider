import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';

import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCompany } from './hooks/useCompany';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match } = props;
  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  const company = useCompany(formik.values.urlType);

  fkChoices = {
    ...fkChoices,
    company,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name', 'urlType', 'company', 'url'],
    },
    {
      legend: '',
      fields: ['color', 'logo'],
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
