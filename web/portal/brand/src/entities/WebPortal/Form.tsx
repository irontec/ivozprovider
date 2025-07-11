import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import { useFormHandler } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form/useFormHandler';

import VirtualPbx from '../VirtualPbx/VirtualPbx';
import { foreignKeyGetter } from './ForeignKeyGetter';
import { useCompany } from './hooks/useCompany';
import WebPortal from './WebPortal';

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
  const canChooseURLType =
    match.pathname.includes(VirtualPbx.localPath) ||
    match.pathname.includes(`/brand${WebPortal.path}`);

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
      fields: ['color', 'logo', 'productName'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      formik={formik}
      fkChoices={fkChoices}
      groups={groups}
      readOnlyProperties={{ urlType: !canChooseURLType }}
    />
  );
};

export default Form;
