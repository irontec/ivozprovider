import EntityService from 'lib/services/entity/EntityService';
import { NullablePropertyFkChoices } from 'lib/entities/DefaultEntityBehavior';
import { CriteriaFilterValue, CriteriaFilterValues } from './ContentFilter';
import FilterIconFactory, { getFilterLabel } from './icons/FilterIconFactory';
import { Tooltip } from '@mui/material';
import { isPropertyFk } from 'lib/services/api/ParsedApiSpecInterface';
import { StyledChip, StyledChipIcon } from './FilterCriteria.styles';

interface FilterCriteriaProps {
  entityService: EntityService,
  fkChoices: { [fldName: string]: NullablePropertyFkChoices },
  path: string,
  criteria: CriteriaFilterValues,
  removeFilter: (index: number) => void,
}

export function FilterCriteria(props: FilterCriteriaProps): JSX.Element | null {

  const { criteria, entityService, fkChoices, removeFilter } = props;
  const columns = entityService.getCollectionParamList();

  return (
    <>
      {criteria.map((criteriaValue: CriteriaFilterValue, idx: number) => {

        const { name, type, value } = criteriaValue;
        const column = columns[name];
        if (!column) {
          return null;
        }
        const fieldStr = column.label;

        let valueStr: string | JSX.Element = value as string;
        if (isPropertyFk(column)) {
          valueStr = (fkChoices[name])?.[value as string] as string;
        } else if (column.enum) {
          valueStr = column.enum[value as string] as string | JSX.Element;
        }

        const icon = (
          <StyledChipIcon fieldName={fieldStr}>
            <FilterIconFactory name={criteriaValue.type} fontSize='small' includeLabel={false} />
          </StyledChipIcon>
        );

        const tooltipTitle = (
          <span>
            {fieldStr} &nbsp;
            {getFilterLabel(type)} &nbsp;
            {valueStr}
          </span>
        );

        return (
          <Tooltip
            key={idx}
            title={tooltipTitle}
          >
            <span>
              <StyledChip
                icon={icon}
                label={valueStr}
                onDelete={() => {
                  removeFilter(idx);
                }}
              />
            </span>
          </Tooltip>
        );
      })}
    </>
  );
}

