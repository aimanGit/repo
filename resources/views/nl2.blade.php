@foreach ($nl as $n)
                        <tr>
                            <td>{{ $n->title }}</td>
                            <td>{{ $n->article }}</td>
                            <td>
                                @if($n->deleted_at > now() || $n->deleted_at == null)
                                    <span class="badge rounded-pill bg-success">Active</span>
                                @elseif($n->deleted_at < now())
                                    <span class="badge rounded-pill bg-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('list.edit',$n->id)}}" class="btn btn-primary btn-sm" style="margin-bottom: 1px; width: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><br>

                                <!-- <a href="#" class="btn btn-primary btn-sm" style="margin-bottom: 1px; width: 30px;"><i class="fa fa-eye" aria-hidden="true"></i></a><br> -->

                                @if($n->deleted_at > now() || $n->deleted_at == null)
                                    <button type="submit" style="width: 30px;" onclick="dltnl('{{$n->id}}','{{$n->title}}')" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                @else
                                    <a href="{{route('list.republish',$n->id)}}" style="width: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Re-Publish Newsletter" class="btn btn-success btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach