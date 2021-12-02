import { useState, useEffect, ReactNode, ReactElement } from 'react';
import FilterBox from './FilterBox';
import _ from 'lib/services/translations/translate';
import { StyledContentFilterRow } from './ContentFilterRow.styles';
import EntityService from 'lib/services/entity/EntityService';

export interface Filter {
    value: string | Array<string>,
    label: string | JSX.Element
}

export type FilterList = Array<Filter>;

export const filterTypes: FilterList = [
    { value: "", label: _("None") },
    { value: "eq", label: _("Equals") },
    { value: "exact", label: _("Equals") },
    //{ value: "neq", label: _("Does not Equal") },
    { value: "start", label: _("Starts with") },
    { value: "partial", label: _("Contains") },
    { value: "end", label: _("Ends with") },
    { value: "gt", label: _("Is greater than") },
    { value: "gte", label: _("Is greater than equal") },
    { value: "lt", label: _("Is lower than") },
    { value: "lte", label: _("Is lower than equal") },
    { value: "exists", label: _("Exists") },
];

export const multSelectFilterTypes = [
    { value: "in", label: _("Is any of") },
];

export const getFilterTypeLabel = (type: string): ReactElement | string => {
    for (const idx in filterTypes) {
        if (filterTypes[idx].value === type) {
            return filterTypes[idx].label;
        }
    }

    for (const idx in multSelectFilterTypes) {
        if (multSelectFilterTypes[idx].value === type) {
            return multSelectFilterTypes[idx].label;
        }
    }

    return '';
}

export const getFilterLabel = (filter: Filter): string | JSX.Element => {

    const hasLabels = filter.label !== undefined;
    const isArrayValue = Array.isArray(filter.value);

    if (!isArrayValue) {

        return hasLabels
            ? filter.label as string
            : filter.value as string;
    }

    if (!hasLabels) {
        const filterValue = filter.value as Array<string>;
        return '[' + filterValue.join(', ') + ']';
    }

    return (<>[${filter.label}]</>);
}

export interface CriteriaFilterValue {
    value: string,
    label: ReactNode,
    type: string,
}

export interface CriteriaFilterValues {
    [name: string]: CriteriaFilterValue | null,
}


interface ContentFilterMenuProps {
    entityService: EntityService,
    open: boolean,
    handleClose: () => void,
    currentFilter: CriteriaFilterValues,
    setFilters: (data: CriteriaFilterValues) => void,
    path: string
}

export function ContentFilterMenu(props: ContentFilterMenuProps): JSX.Element | null {

    const {
        entityService,
        open,
        handleClose,
        currentFilter,
        setFilters,
        path
    } = props;

    const [mounted, setMounted] = useState<boolean>(true);
    const [loading, setLoading] = useState<boolean>(true);
    const [foreignEntities, setForeignEntities] = useState<any>({});
    const [criteria, setCriteria] = useState<CriteriaFilterValues>({ ...currentFilter });
    const columns = entityService.getCollectionParamList();
    const foreignKeyGetter = entityService.getForeignKeyGetter();

    useEffect(
        () => {
            if (mounted && loading) {
                foreignKeyGetter()
                    .then((foreignEntities: any) => {
                        if (!mounted) {
                            return;
                        }
                        setForeignEntities(foreignEntities);
                        setLoading(false);
                    });
            }

            return function umount() {
                setMounted(false);
            };
        },
        [mounted, loading, foreignKeyGetter]
    );

    const apply = () => {
        setFilters(criteria);
        handleClose();
    };

    const setFilter = (fld: string, filterType: string, value: any, label?: any) => {

        const filterValue = filterType !== ''
            ? { type: filterType, value, label }
            : null;

        const filter: CriteriaFilterValues = {
            [fld]: filterValue
        };

        setCriteria({
            ...criteria,
            ...filter
        });
    };

    const columnNames: Array<string> = Object.keys(columns);

    if (!mounted && loading) {
        return null;
    }

    return (
        <FilterBox
            open={open}
            handleClose={handleClose}
            apply={apply}
        >
            {columnNames.map((key: string, idx: number): JSX.Element | null => {

                const propertyFilter = entityService.getPropertyFilters(key, path);
                if (!propertyFilter.length) {
                    debugger;
                    return null;
                }

                const propertyFilterTypes = filterTypes.filter((type: any) => {
                    return propertyFilter.includes(type.value);
                });

                const currentCriteria = criteria[key] as CriteriaFilterValue || {};
                const hasValue = criteria[key] && currentCriteria.value;
                const currentFilterType = hasValue
                    ? currentCriteria.type
                    : '';

                const currentFilterValues: any = {
                    value: '',
                    type: currentFilterType
                };

                if (!criteria[key]) {
                    return (
                        <StyledContentFilterRow
                            values={currentFilterValues}
                            key={key}
                            rowNum={idx}
                            columnName={key}
                            columnLabel={columns[key].label as string}
                            setFilter={setFilter}
                            filterTypes={propertyFilterTypes}
                            choices={foreignEntities[key]}
                        />
                    );
                }

                const isArrayValue = hasValue && Array.isArray(currentCriteria.value);

                if (isArrayValue) {
                    const valueNumber = currentCriteria.value.length;
                    currentFilterValues.value = [];

                    for (let i = 0; i < valueNumber; i++) {
                        currentFilterValues.value.push({
                            id: currentCriteria.value[i],
                            label: currentCriteria.label || null
                        });
                    }
                } else if (hasValue) {
                    currentFilterValues.value = currentCriteria.value;
                }

                return (
                    <StyledContentFilterRow
                        values={currentFilterValues}
                        key={key}
                        rowNum={idx}
                        columnName={key}
                        columnLabel={columns[key].label as string}
                        setFilter={setFilter}
                        filterTypes={propertyFilterTypes}
                        choices={foreignEntities[key]}
                    />
                );
            })}
        </FilterBox>
    );
}

