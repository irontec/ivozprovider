import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import { foreignKeyGetter } from './ForeignKeyGetter';
import { useIntercompanyId } from './hooks/useIntercompanyId';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, edit } = props;
  let fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
  });

  const formik = useFormHandler(props);
  const interCompany = useIntercompanyId({
    edit: edit,
    formik: formik,
  });

  fkChoices = {
    ...fkChoices,
    interCompany,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Main'),
      fields: [
        'company',
        'directConnectivity',
        'name',
        'password',
        'transport',
        'ip',
        'port',
        'ruriDomain',
        'interCompany',
        'description',
      ],
    },
  ];

  const readOnlyProperties = {
    company: edit,
    interCompany: edit,
  };

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={readOnlyProperties}
    />
  );
};

export default Form;
