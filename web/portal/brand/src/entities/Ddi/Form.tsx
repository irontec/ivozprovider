import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';

import { foreignKeyGetter } from './ForeignKeyGetter';
import useDefaultCountryId from './hooks/useDefaultCountryId';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, create, edit } = props;
  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  useDefaultCountryId({
    create,
    formik,
  });

  const readOnlyProperties = {
    company: edit || false,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: 'Number data',
      fields: [
        'company',
        'country',
        'ddi',
        'type',
        'ddiProvider',
        'description',
      ],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={readOnlyProperties}
      fkChoices={fkChoices}
      groups={groups}
      formik={formik}
    />
  );
};

export default Form;
