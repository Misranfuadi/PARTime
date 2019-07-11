package com.example.misra.myapplication.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.misra.myapplication.Model.Tempat;
import com.example.misra.myapplication.R;

import java.util.List;

public class TempatAdapter extends  RecyclerView.Adapter<TempatAdapter.MyViewHolder>  {

    private List<Tempat> tempatList;

    public TempatAdapter(List<Tempat> tempatlList) {
        this.tempatList = tempatlList;
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.tempat_recycle_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull TempatAdapter.MyViewHolder holder, int position) {
        Tempat tempat = tempatList.get(position);
        holder.nama.setText(tempat.getNama());
        holder.alamat.setText(tempat.getAlamat());
    }

    @Override
    public int getItemCount() {
        return tempatList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView nama, alamat;

        public MyViewHolder(View view) {
            super(view);
            nama =  view.findViewById(R.id.nama);
            alamat =  view.findViewById(R.id.alamat);
        }
    }
}
